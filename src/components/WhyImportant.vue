<template>
<section class="section">
<div class="container">
  <h2>Почему это важно</h2>
  <div class="grid-2">
    <div class="text-block">
      <p>
        Кадастровая стоимость напрямую влияет на размер налога.
        Если характеристики объекта указаны неверно, система может рассчитать стоимость значительно выше.
      </p>

      <div class="danger-box">
        <h3>Это может привести к:</h3>
        <ul>
          <li>увеличению налога на имущество</li>
          <li>переплатам на несколько лет</li>
          <li>необходимости долгого оспаривания стоимости</li>
        </ul>
      </div>

      <p class="note">Проверка данных помогает избежать этих проблем.</p>
    </div>
    <div class="visual-block">
      <img class="statistics-img" alt="statistics" src="../assets/statistics.png">
    </div>
  </div>
</div>
</section>
</template>

<style scoped>
.section { padding: 60px 0; }
h2 { font-size: 32px; margin-bottom: 40px; text-align: center; }

.grid-2 {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 40px;
  align-items: center;
}

.danger-box {
  background-color: var(--danger-bg);
  color: var(--danger-text);
  padding: 20px;
  border-radius: 8px;
  margin: 20px 0;
}

.danger-box h3 { margin-bottom: 10px; }
.danger-box ul { padding-left: 20px; }
.danger-box li { margin-bottom: 8px; }

.note { font-style: italic; color: var(--text-secondary); }

.visual-block {
  margin: 0 auto;
}

.statistics-img {
  max-width: 700px;
}

@media (max-width: 1100px) {
  .statistics-img {
    max-width: 45vw;
  }
}

@media (max-width: 768px) {
  .grid-2 { grid-template-columns: 1fr; }
  .statistics-img {
    max-width: 85vw;
  }
}
</style>