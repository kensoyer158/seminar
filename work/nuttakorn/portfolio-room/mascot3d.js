// ตัวละคร 3D: แผ่นภาพนูนจาก depth map + หันตามเมาส์ + หายใจ + กระโดด
(function () {
  if (!window.THREE) return
  var W = 1600, H = 900
  var cv = document.getElementById('gl')
  var r = new THREE.WebGLRenderer({ canvas: cv, alpha: true, antialias: true })
  r.setPixelRatio(Math.min(devicePixelRatio, 2))
  var scene = new THREE.Scene()
  var cam = new THREE.OrthographicCamera(-1, 1, 1, -1, -2000, 2000)
  function fit() {
    var w = innerWidth, h = innerHeight, s = Math.max(w / W, h / H)
    r.setSize(w, h, false)
    var vw = w / s / 2, vh = h / s / 2
    cam.left = W / 2 - vw; cam.right = W / 2 + vw; cam.top = H / 2 + vh; cam.bottom = H / 2 - vh
    cam.updateProjectionMatrix()
  }
  addEventListener('resize', fit); fit()

  var L = new THREE.TextureLoader()
  var tex = L.load(IMG), dep = L.load(DEP)
  tex.anisotropy = 8
  var ph = 700, pw = ph * 815 / 1863
  var mat = new THREE.ShaderMaterial({
    transparent: true, side: THREE.DoubleSide,
    uniforms: { map: { value: tex }, dep: { value: dep }, amp: { value: 70 } },
    vertexShader: 'varying vec2 v;uniform sampler2D dep;uniform float amp;void main(){v=uv;float d=texture2D(dep,uv).r;vec3 p=position;p.z+=(d-.5)*amp;gl_Position=projectionMatrix*modelViewMatrix*vec4(p,1.);}',
    fragmentShader: 'varying vec2 v;uniform sampler2D map;uniform sampler2D dep;void main(){vec4 c=texture2D(map,v);if(c.a<.02)discard;vec2 e=vec2(1./300.);float dx=texture2D(dep,v+vec2(e.x,0)).r-texture2D(dep,v-vec2(e.x,0)).r;float dy=texture2D(dep,v+vec2(0,e.y)).r-texture2D(dep,v-vec2(0,e.y)).r;vec3 n=normalize(vec3(-dx*6.,-dy*6.,1.));float l=.82+.3*dot(n,normalize(vec3(-.4,.5,.8)));gl_FragColor=vec4(c.rgb*l,c.a);}'
  })
  var pivot = new THREE.Group()           // หมุนรอบเอว
  var mesh = new THREE.Mesh(new THREE.PlaneGeometry(pw, ph, 100, 240), mat)
  mesh.position.set(0, ph * 0.18, 0)      // เอวอยู่ที่จุดหมุน
  pivot.add(mesh); scene.add(pivot)
  var baseX = 800, baseY = H - (95 + ph * 0.5 + ph * 0.18) // พิกัด y กลับด้าน
  var mx = 0, my = 0, tx = 0, ty = 0, awake = 0, hopT = -1, sleepAmt = 1
  addEventListener('pointermove', function (e) { mx = e.clientX / innerWidth * 2 - 1; my = e.clientY / innerHeight * 2 - 1 })
  window.hop3d = function () { hopT = 0 }
  var ray = new THREE.Raycaster(), v2 = new THREE.Vector2()
  addEventListener('click', function (e) {
    v2.set(e.clientX / innerWidth * 2 - 1, -(e.clientY / innerHeight) * 2 + 1)
    ray.setFromCamera(v2, cam)
    if (ray.intersectObject(mesh).length && !e.target.closest('button,#hint,#card,#pages')) {
      document.body.classList.contains('awake') ? hop3d() : document.getElementById('hint').click()
    }
  })
  var t0 = performance.now()
  ;(function loop(now) {
    var t = (now - t0) / 1000
    var a = document.body.classList.contains('awake') ? 1 : 0
    sleepAmt += ((1 - a) - sleepAmt) * 0.06
    tx += (mx - tx) * 0.08; ty += (my - ty) * 0.08
    var breathe = Math.sin(t * 1.9) * 0.008
    var hop = 0, sq = 1
    if (hopT >= 0) { hopT += 0.03; var k = hopT; if (k >= 1) hopT = -1; else { hop = Math.sin(k * Math.PI) * 46; sq = 1 + Math.sin(k * Math.PI) * 0.04 } }
    pivot.position.set(baseX, baseY - sleepAmt * 150 + hop + Math.sin(t * 1.5) * sleepAmt * 3, 0)
    pivot.rotation.y = tx * 0.5 * (1 - sleepAmt * 0.6)
    pivot.rotation.x = ty * 0.12
    pivot.rotation.z = -0.09 * sleepAmt
    pivot.scale.set(1 / sq + breathe, sq + breathe, 1)
    r.render(scene, cam)
    requestAnimationFrame(loop)
  })(t0)
})()
