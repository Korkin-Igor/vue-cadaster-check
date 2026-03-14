<template>
  <section id="free-check-section" class="cta-section">
    <div class="container cta-content">
      <h2>Бесплатная проверка объекта</h2>

      <div class="cta-grid">
        <div class="help-list">
          <h3>Мы поможем:</h3>
          <ul>
            <li v-for="item in helpItems" :key="item">• {{ item }}</li>
          </ul>
        </div>
        <div class="free-badge">
          Проверка и консультация бесплатны.
        </div>
      </div>

      <button class="btn-white">Проверить объект</button>
    </div>
  </section>
</template>

<script setup>
const helpItems = [
  'Проверить актуальность данных недвижимости',
  'Выявить возможные ошибки',
  'Объяснить, нужно ли подавать декларацию',
  'Предоставить пошаговую инструкцию'
];
</script>

<style scoped>
.cta-section {
  background-color: var(--primary-color);
  color: white;
  padding: 80px 0;
  text-align: center;
}

.cta-content {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 40px;
}

h2 { font-size: 36px; }

.cta-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 40px;
  width: 100%;
  max-width: 800px;
  background: rgba(255, 255, 255, 0.1);
  padding: 30px;
  border-radius: 16px;
  text-align: left;
}

.help-list h3 { margin-bottom: 15px; font-size: 22px; }
.help-list ul { list-style: none; }
.help-list li { margin-bottom: 10px; font-size: 18px; }

.free-badge {
  background: rgba(255, 255, 255, 0.2);
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  font-weight: bold;
  font-size: 20px;
  padding: 20px;
}

.btn-white {
  background-color: white;
  color: var(--primary-color);
  padding: 15px 40px;
  border-radius: 8px;
  font-weight: bold;
  font-size: 18px;
  border: none;
  cursor: pointer;
  transition: transform 0.2s;
}

.btn-white:hover {
  transform: scale(1.05);
  background-color: #f8fafc;
}

@media (max-width: 768px) {
  .cta-grid { grid-template-columns: 1fr; text-align: center; }
  .help-list ul { padding: 0; display: inline-block; text-align: left; }
}
</style>