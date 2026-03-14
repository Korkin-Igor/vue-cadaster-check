<template>
  <header class="header">
    <div class="container header-container">
      <a href="#" class="logo" @click.prevent="scrollToTop">
        <img src="../assets/logo.png" class="logo-icon" alt="logo">
      </a>

      <nav class="nav-desktop">
        <a v-for="link in navLinks" :key="link.id" :href="'#' + link.id" @click.prevent="scrollToSection(link.id)">
          {{ link.label }}
        </a>
      </nav>

      <button class="burger-btn" @click="toggleMenu" :class="{ active: isMenuOpen }" aria-label="Меню">
        <span></span>
        <span></span>
        <span></span>
      </button>

      <transition name="slide">
        <div v-if="isMenuOpen" class="mobile-menu">
          <nav class="nav-mobile">
            <a v-for="link in navLinks" :key="link.id" :href="'#' + link.id" @click="handleMobileClick(link.id)">
              {{ link.label }}
            </a>
          </nav>
        </div>
      </transition>
    </div>
  </header>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

const isMenuOpen = ref(false);

const navLinks = [
  { id: 'why', label: 'Почему важно' },
  { id: 'who', label: 'Кому проверить' },
  { id: 'what', label: 'Что сделать' },
  { id: 'how', label: 'Как подать' },
  { id: 'free-check-section', label: 'Проверка' },
  { id: 'contacts', label: 'Контакты' }
];

const toggleMenu = () => {
  isMenuOpen.value = !isMenuOpen.value;
  document.body.style.overflow = isMenuOpen.value ? 'hidden' : '';
};

const scrollToSection = (id) => {
  const element = document.getElementById(id);
  if (element) {
    const headerOffset = 80;
    const elementPosition = element.getBoundingClientRect().top;
    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

    window.scrollTo({
      top: offsetPosition,
      behavior: 'smooth'
    });
  }
};

const scrollToTop = () => {
  window.scrollTo({ top: 0, behavior: 'smooth' });
};

const handleMobileClick = (id) => {
  isMenuOpen.value = false;
  document.body.style.overflow = '';
  setTimeout(() => scrollToSection(id), 300);
};

const handleClickOutside = (event) => {
  const burger = document.querySelector('.burger-btn');
  const menu = document.querySelector('.mobile-menu');
  if (isMenuOpen.value && burger && menu && !burger.contains(event.target) && !menu.contains(event.target)) {
    toggleMenu();
  }
};

onMounted(() => {
  document.addEventListener('click', handleClickOutside);
});

onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside);
  document.body.style.overflow = '';
});
</script>

<style scoped>
.header {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  background-color: var(--white);
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  z-index: 1000;
  height: 70px;
}

.header-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 20px;
  height: 100%;
}

.logo {
  display: flex;
  align-items: center;
  gap: 10px;
  text-decoration: none;
  color: var(--text-main);
  font-weight: 700;
  font-size: 20px;
}

.logo-icon {
  width: 50px;
}

.nav-desktop {
  display: none;
  gap: 30px;
}

.nav-desktop a {
  text-decoration: none;
  color: var(--text-secondary);
  font-weight: 500;
  font-size: 15px;
  transition: color 0.3s;
  position: relative;
}

.nav-desktop a:hover {
  color: var(--primary-color);
}

.nav-desktop a::after {
  content: '';
  position: absolute;
  bottom: -5px;
  left: 0;
  width: 0;
  height: 2px;
  background-color: var(--primary-color);
  transition: width 0.3s;
}

.nav-desktop a:hover::after {
  width: 100%;
}

.burger-btn {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  width: 30px;
  height: 24px;
  background: none;
  border: none;
  cursor: pointer;
  padding: 0;
  z-index: 1001;
}

.burger-btn span {
  display: block;
  width: 100%;
  height: 3px;
  background-color: var(--text-main);
  border-radius: 2px;
  transition: all 0.3s ease;
}

.burger-btn.active span:nth-child(1) {
  transform: translateY(10.5px) rotate(45deg);
}

.burger-btn.active span:nth-child(2) {
  opacity: 0;
}

.burger-btn.active span:nth-child(3) {
  transform: translateY(-10.5px) rotate(-45deg);
}

.mobile-menu {
  position: fixed;
  top: 70px;
  left: 0;
  right: 0;
  background-color: var(--white);
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  padding: 20px;
}

.nav-mobile {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.nav-mobile a {
  text-decoration: none;
  color: var(--text-main);
  font-weight: 500;
  font-size: 18px;
  padding: 10px 0;
  border-bottom: 1px solid #e5e7eb;
  transition: color 0.3s;
}

.nav-mobile a:hover {
  color: var(--primary-color);
}

.nav-mobile a:last-child {
  border-bottom: none;
}

.slide-enter-active,
.slide-leave-active {
  transition: all 0.3s ease;
}

.slide-enter-from,
.slide-leave-to {
  opacity: 0;
  transform: translateY(-20px);
}

@media (min-width: 800px) {
  .header-container {
    justify-content: center;
  }
  .nav-desktop {
    display: flex;
  }
  .burger-btn,
  .mobile-menu {
    display: none;
  }
}
</style>