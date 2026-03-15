<template>
  <section
      ref="sectionRef"
      class="section-dark"
      id="who"
      :class="{ 'animate-visible': isVisible }"
  >
    <div class="container">
      <h2 class="section-title">Кому стоит проверить объект</h2>
      <p class="section-subtitle">Проверка актуальна для владельцев:</p>

      <div class="cards-grid">
        <div
            v-for="(item, index) in items"
            :key="item.label"
            class="card"
            :style="{ animationDelay: index * 0.1 + 's' }"
        >
          <div class="card-image-wrapper">
            <img
                :src="item.image"
                :alt="item.label"
                class="card-image"
                loading="lazy"
            >
          </div>
          <h3 class="card-title">{{ item.label }}</h3>
          <div class="card-decoration"></div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

import commercialImg from '../assets/who-needs-it/commercial.png';
import premisesImg from '../assets/who-needs-it/premises.png';
import buildingsImg from '../assets/who-needs-it/buildings.png';
import unfinishedImg from '../assets/who-needs-it/unfinished.png';
import parkingImg from '../assets/who-needs-it/parking.png';
import apartmentsImg from '../assets/who-needs-it/apartments.png';

const sectionRef = ref(null);
const isVisible = ref(false);
let observer = null;

const items = ref([
  {
    label: 'Коммерческой недвижимости',
    image: commercialImg
  },
  {
    label: 'Помещений',
    image: premisesImg
  },
  {
    label: 'Зданий и сооружений',
    image: buildingsImg
  },
  {
    label: 'Объектов незавершенного строительства',
    image: unfinishedImg
  },
  {
    label: 'Машино-мест',
    image: parkingImg
  },
  {
    label: 'Квартир и жилых домов',
    image: apartmentsImg
  }
]);

onMounted(() => {
  observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            isVisible.value = true;
            if (observer) {
              observer.unobserve(entry.target);
            }
          }
        });
      },
      {
        threshold: 0.2,
        rootMargin: '0px 0px -100px 0px'
      }
  );

  if (sectionRef.value) {
    observer.observe(sectionRef.value);
  }
});

onUnmounted(() => {
  if (observer) {
    observer.disconnect();
  }
});
</script>

<style scoped>
.section-dark {
  padding: 80px 0;
  background-color: #374151;
  color: #ffffff;
}

.section-title {
  font-size: 36px;
  text-align: center;
  margin-bottom: 12px;
  font-weight: 700;
  letter-spacing: -0.5px;
}

.section-subtitle {
  text-align: center;
  color: #9ca3af;
  margin-bottom: 50px;
  font-size: 18px;
}

.cards-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 24px;
}

.card {
  background: var(--white);
  color: var(--text-main);
  padding: 30px 20px;
  border-radius: 12px;
  text-align: center;
  font-weight: 600;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-start;
  min-height: 220px;

  animation-play-state: paused;
  opacity: 0;
  transform: translateY(20px);
}

.section-dark.animate-visible .card {
  animation: fadeInUp 0.6s ease-out forwards;
  animation-play-state: running;
}

.card:hover {
  transform: translateY(-8px);
  box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2);
}

.card-image-wrapper {
  width: 80px;
  height: 80px;
  margin-bottom: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 12px;
  padding: 10px;
  transition: transform 0.3s ease;
}

.card:hover .card-image-wrapper {
  transform: scale(1.1);
}

.card-image {
  width: 150px;
  object-fit: contain;
  display: block;
}

.card-title {
  font-size: 18px;
  line-height: 1.4;
  margin: 0;
  z-index: 2;
  flex-grow: 1;
  display: flex;
  align-items: center;
}

.card-decoration {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 5px;
  background: linear-gradient(90deg, #2563eb, #3b82f6);
  opacity: 0;
  transform-origin: left;
}

.card:hover .card-decoration {
  opacity: 1;
  transition: .6s;
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@media (max-width: 768px) {
  .section-title { font-size: 28px; }
  .section-dark { padding: 50px 0; }
  .cards-grid { grid-template-columns: 1fr; }

  .card-image-wrapper {
    width: 70px;
    height: 70px;
  }
}
</style>