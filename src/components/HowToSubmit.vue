<template>
  <section class="section bg-light">
    <div class="container">
      <h2>Как подать декларацию</h2>

      <div class="split-layout">
        <div class="methods">
          <h3>Выберите удобный способ</h3>
          <ul class="methods-list">
            <li v-for="method in methods" :key="method.text">
              <span class="emoji">{{ method.icon }}</span>
              {{ method.text }}
            </li>
          </ul>
          <p class="small-text">Рассмотрение заявления занимает до 30 рабочих дней.</p>
        </div>

        <div class="timing-box">
          <h3>Когда лучше подать?</h3>
          <p>
            Декларации принимаются постоянно, но лучше подать их <strong>до начала кадастровой оценки</strong>.
          </p>
          <p>Это позволит учесть корректные данные при расчете стоимости.</p>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
const methods = [
  { icon: '🏢', text: 'Через МФЦ' },
  { icon: '👤', text: 'Лично в ГБУ' },
  { icon: '🌐', text: 'Через портал Госуслуг' },
  { icon: '✉️', text: 'По почте с уведомлением' } // Здесь встроен спецсимвол-селектор
];
</script>

<style scoped>
.section { padding: 60px 0; background-color: var(--bg-light); }
h2 { font-size: 32px; text-align: center; margin-bottom: 40px; }

.split-layout {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 40px;
}

.methods h3, .timing-box h3 { margin-bottom: 20px; font-size: 22px; }

.methods-list { list-style: none; }
.methods-list li {
  background: var(--white);
  padding: 15px;
  margin-bottom: 10px;
  border-radius: 8px;
  display: flex;
  align-items: center;
  gap: 15px;
  font-size: 18px;
}

.emoji {
  width: 20px;
}
.small-text { margin-top: 20px; color: var(--text-secondary); font-size: 14px; }

.timing-box {
  background-color: #1f2937;
  color: white;
  padding: 30px;
  border-radius: 12px;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.timing-box strong { color: #60a5fa; }
.timing-box p { margin-bottom: 15px; opacity: 0.9; }

@media (max-width: 768px) {
  .split-layout { grid-template-columns: 1fr; }
}
</style>