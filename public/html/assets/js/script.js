document.addEventListener('DOMContentLoaded', () => {
  // hero hover
  const heroWrapper = document.querySelector('.hero-wrapper');
  const boxes = document.querySelectorAll('.box');

  const defaultBg = '/assets/images/herobackground.jpg';

  boxes.forEach(box => {
    const bg = box.dataset.bg;

    box.addEventListener('mouseenter', () => {
      heroWrapper.style.backgroundImage = `url('${bg}')`;
    });

    box.addEventListener('mouseleave', () => {
      heroWrapper.style.backgroundImage = `url('${defaultBg}')`;
    });
  });

  // hamburger
  const hamburger = document.querySelector('.hamburger');
  const dropdown = document.querySelector('.dropdown-mobile');
  const hamburgerImg = hamburger.querySelector('img');

  hamburger.addEventListener('click', () => {
    dropdown.classList.toggle('active');

    const isOpen = dropdown.classList.contains('active');

    hamburgerImg.src = isOpen ? '/assets/images/close-svgrepo-com.svg' : '/assets/images/hamburger-md-svgrepo-com.svg';
  });

  // hero bottom form inners
  const containerShip = document.querySelector('.container-ship');
  const formButtons = containerShip.querySelectorAll('.item-form-ship');

  formButtons.forEach(button => {
    button.addEventListener('click', () => {
      formButtons.forEach(b => b.classList.remove('active'));
      button.classList.add('active');
    });
  });
  document.addEventListener('click', e => {
    const isInsideForm = e.target.closest('.item-form-ship');

    if (!isInsideForm) {
      document.querySelectorAll('.item-form-ship').forEach(item => {
        item.classList.remove('active');
      });
    }
  });

  // tabs - container loose panel
  const buttons = document.querySelectorAll('.item-nav');
  const loosePanel = document.querySelector('.loose-panel');
  const containerPanel = document.querySelector('.container-panel');

  buttons.forEach(button => {
    button.addEventListener('click', () => {
      const type = button.dataset.type;

      loosePanel.style.display = 'none';
      containerPanel.style.display = 'none';

      if (type === 'loose') loosePanel.style.display = 'flex';
      if (type === 'container') containerPanel.style.display = 'flex';

      buttons.forEach(b => {
        b.classList.remove('active');

        const img = b.querySelector('img');
        img.src = b.dataset.defaultImg;
      });

      button.classList.add('active');
      button.querySelector('img').src = button.dataset.activeImg;
    });
  });

  // pallets => boxes / crates
  const palletBtn = document.querySelector('.pallet-btn');
  const boxesBtn = document.querySelector('.boxes-btn');
  const boxesContent = document.querySelector('.boxes-extra-content');

  palletBtn.addEventListener('click', () => {
    palletBtn.classList.add('active');
    boxesBtn.classList.remove('active');

    boxesContent.classList.remove('show');
  });

  boxesBtn.addEventListener('click', () => {
    boxesBtn.classList.add('active');
    palletBtn.classList.remove('active');

    boxesContent.classList.add('show');
  });

  // toggle msg button
  const button = document.querySelector('.overlay-button-mail');
  const dropdownMsg = document.querySelector('.dropdown-mail');
  const closeButton = document.querySelector('.close-button');
  function toggleDropdownMessage() {
    if (button) {
      button.style.display = 'none';
      dropdownMsg.style.opacity = '1';
      dropdownMsg.style.pointerEvents = 'all';
    }
  }

  closeButton.addEventListener('click', () => {
    button.style.display = 'flex';
    dropdownMsg.style.opacity = '0';
    dropdownMsg.style.pointerEvents = 'none';
  });

  button.addEventListener('click', toggleDropdownMessage);
});

const navItems = document.querySelectorAll('.navbar li');

navItems.forEach(li => {
  const img = li.querySelector('img');
  const originalSrc = img.getAttribute('src');
  const hoverSrc = '/assets/images/carethover.png';

  li.addEventListener('mouseenter', () => {
    img.setAttribute('src', hoverSrc);
  });

  li.addEventListener('mouseleave', () => {
    img.setAttribute('src', originalSrc);
  });
});
