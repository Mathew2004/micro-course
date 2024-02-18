
<style>
  @import url("https://fonts.googleapis.com/css2?family=Michroma&display=swap");
* {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}
body {
  height: 100vh;
}

.preloader-container {
  font-family: "Michroma", sans-serif;
  background-color: black;
  color: #fff;
  height: 100%;
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
}

.preloader-loading-page {
  font-family: "Michroma", sans-serif;
  position: absolute;
  top: 0;
  left: 0;
  z-index: 9999;
  background: linear-gradient(to right, #2c5364, #203a43, #0f2027);
  height: 100%;
  width: 100%;
  display: flex;
  flex-direction: column;
  gap: 10px;
  align-items: center;
  justify-content: center;
  color: #191654;
}

#preloader-svg {
  height: 145px;
  width: 220px;
  stroke: white;
  fill-opacity: 0;
  stroke-width: 3px;
  stroke-dasharray: 4500;
  animation: draw 8s ease;
}

@keyframes draw {
  0% {
    stroke-dashoffset: 4500;
  }
  100% {
    stroke-dashoffset: 0;
  }
}

.preloader-name-container {
  height: 30px;
  overflow: hidden;
}

.preloader-logo-name {
  color: #fff;
  font-size: 16px;
  letter-spacing: 4px;
  text-transform: uppercase;
  /* margin-left: 20px; */
  font-weight: bolder;
}

@media only screen and (max-width: 600px) {
  #preloader-svg {
    height: 135px;
    width: 180px;
  }
  .preloader-logo-name {
    font-size: 13px;
    letter-spacing: 2px;
  }
  .preloader-loading-page{
    gap: 0px;
  }
}
    </style>

 

    <div class="preloader-loading-page">
        
        
        <svg id="preloader-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 270.15 151.86"><defs><style>.cls-1{fill:none;stroke:#fff;stroke-miterlimit:10;stroke-width:5px;}</style></defs><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><polygon class="cls-1" points="171.41 148.32 128.29 148.21 98.06 95.73 88.24 78.68 77.52 97.12 47.95 148 4.34 147.89 55.77 59.38 66.49 40.93 87.39 4.96 109.33 42.38 119.12 59.1 171.41 148.32"/><path class="cls-1" d="M265.67,16.19,250.76,45.83a38.31,38.31,0,0,0-55.76,17L176.39,31.1a71.45,71.45,0,0,1,89.28-14.91Z"/><path class="cls-1" d="M266.8,139.31A71.52,71.52,0,0,1,252,146c-.7.22-1.36.42-2,.61a74.89,74.89,0,0,1-8.65,1.87,76.88,76.88,0,0,1-23.24-.06l-.24,0-.33-.06c-1.12-.19-2.25-.43-3.38-.68h0l-.42-.1h0c-1.15-.28-2.31-.58-3.47-.92l-.32-.09a61.48,61.48,0,0,1-35.42-28L160.86,95.27l-9.77-16.68-4.62,8.82-22-37.56,4.86-8.42h0L149.22,6.79l20,34.1.85,1.46,21.81,37.21,14.26,24.34a0,0,0,0,1,0,0c.29.45,4.69,7.29,9,9.36a4.66,4.66,0,0,0,.66.28c1.19.48,2.44.91,3.7,1.28a38.22,38.22,0,0,0,31.31-4.51Z"/><polygon class="cls-1" points="106.92 148.15 67.97 148.06 87.4 114.27 106.92 148.15"/></g></g></svg>

        <div class="preloader-name-container">
            <div class="preloader-logo-name">ASG Micro Course</div>
        </div>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/gsap.min.js"
    integrity="sha512-gmwBmiTVER57N3jYS3LinA9eb8aHrJua5iQD7yqYCKa5x6Jjc7VDVaEA0je0Lu0bP9j7tEjV3+1qUm6loO99Kw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    gsap.fromTo(
  ".preloader-loading-page",
  { opacity: 1 },
  {
    opacity: 0,
    display: "none",
    duration: 1.5,
    delay: 3.5,
  }
);

gsap.fromTo(
  ".preloader-logo-name",
  {
    y: 50,
    opacity: 0,
  },
  {
    y: 0,
    opacity: 1,
    duration: 2,
    delay: 0.5,
  }
);

</script>