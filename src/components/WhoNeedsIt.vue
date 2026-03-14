<template>
  <section class="section bg-light" id="who">
    <div class="container">
      <h2>Кому стоит проверить объект</h2>
      <p class="subtitle">Проверка актуальна для владельцев:</p>

      <div class="cards-grid">
        <div v-for="item in items" :key="item" class="card">
          {{ item }}
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue';

const items = ref([
  'Коммерческой недвижимости',
  'Помещений',
  'Зданий и сооружений',
  'Объектов незавершенного строительства',
  'Машино-мест',
  'Квартир и жилых домов'
]);
</script>

<style scoped>
.section { padding: 60px 0; background-color: var(--bg-light); }
h2 { font-size: 32px; text-align: center; margin-bottom: 10px; }
.subtitle { text-align: center; color: var(--text-secondary); margin-bottom: 40px; }

.cards-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 20px;
}

.card {
  background: var(--white);
  padding: 20px;
  border-radius: 8px;
  text-align: center;
  font-weight: 500;
  box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}
</style>