<template>
  <section class="hero">
    <div class="container hero-content">
      <span class="badge">Ставропольский край</span>
      <h1>Переоценка недвижимости в 2027 году</h1>
      <p class="lead">
        В 2027 году в регионе пройдет государственная кадастровая оценка.
        По её результатам будет рассчитываться налог на имущество на ближайшие 4 года.
      </p>

      <div class="alert-box">
        <p>
          Если в данных вашего объекта есть ошибки, кадастровая стоимость может оказаться выше реальной — а налог увеличится.
        </p>
        <p class="success-text">
          &#9989; Проверьте данные объекта заранее и убедитесь, что всё указано корректно
        </p>
      </div>

      <button @click="scrollToCheck" class="btn-primary">Проверить объект</button>
    </div>
  </section>
</template>

<script setup>
const scrollToCheck = () => {
  document.getElementById('free-check-section')?.scrollIntoView({ behavior: 'smooth' });
};
</script>

<style scoped>
.hero {
  background-image: url("../assets/map.png");
  background-size: cover;
  background-repeat: no-repeat;
  padding: 80px 0;
  text-align: center;
}

.hero-content {
  background-color: rgba(255, 255, 255, .95);
  border-radius: 15px;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 24px;
  padding: 20px;
}

.badge {
  background-color: #dbeafe;
  color: #1e40af;
  padding: 6px 12px;
  border-radius: 20px;
  font-size: 14px;
  font-weight: 600;
  text-transform: uppercase;
}

h1 {
  font-size: 36px;
  line-height: 1.2;
  max-width: 800px;
}

.lead {
  font-size: 18px;
  color: var(--text-secondary);
  max-width: 700px;
}

.alert-box {
  background: var(--white);
  padding: 24px;
  border-radius: 12px;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
  max-width: 800px;
  width: 100%;
  text-align: left;
  border: 1px solid #e5e7eb;
}

.success-text {
  margin-top: 16px;
  color: var(--success-text);
  font-weight: 600;
}

@media (max-width: 768px) {
  h1 { font-size: 28px; }
  .hero { padding: 40px 0; }
  .hero-content { max-width: 95%; }
}
</style>