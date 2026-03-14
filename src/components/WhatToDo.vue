<template>
  <section class="section">
    <div class="container">
      <h2>Что можно сделать сейчас</h2>

      <div class="info-block">
        <h3>Собственники могут подать декларацию об уточнении характеристик объекта.</h3>
        <p>Это позволяет:</p>
        <ul class="check-list">
          <li v-for="item in benefits" :key="item">
            <span class="icon">&#10003;</span> {{ item }}
          </li>
        </ul>
      </div>
    </div>
  </section>
</template>

<script setup>
const benefits = [
  'Исправить возможные ошибки',
  'Уточнить характеристики недвижимости',
  'Обеспечить более точный расчет кадастровой стоимости',
  'Снизить риск завышенного налога'
];
</script>

<style scoped>
.section { padding: 60px 0; }
h2 { font-size: 32px; text-align: center; margin-bottom: 40px; }

.info-block {
  background-color: #eff6ff;
  padding: 40px;
  border-radius: 16px;
  border: 1px solid #bfdbfe;
}

.info-block h3 { color: #1e3a8a; margin-bottom: 16px; }
.info-block p { margin-bottom: 20px; font-weight: 500; }

.check-list { list-style: none; }
.check-list li {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 12px;
  font-size: 18px;
}

.icon {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 24px;
  height: 24px;
  background-color: var(--primary-color);
  color: white;
  border-radius: 50%;
  font-size: 14px;
  flex-shrink: 0;
}
</style>