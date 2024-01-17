function createFlower() {
    const flowerContainer = document.querySelector('.flower-container');
    const flower = document.createElement('div');
    flower.classList.add('flower');
    const initialX = Math.random() * window.innerWidth;
    flower.style.left = initialX + 'px';
    flowerContainer.appendChild(flower);
    flower.addEventListener('animationiteration', () => {
      flower.remove(); // Hapus bunga setelah iterasi animasi selesai
    });
  }
  
  setInterval(createFlower, 1000); // Buat bunga setiap detik
  