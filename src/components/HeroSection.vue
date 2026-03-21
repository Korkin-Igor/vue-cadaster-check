<template>
  <section class="hero">
    <div class="container hero-content">
      <span class="badge">Ставропольский край</span>
      <h1>
        <p>Получить бесплатно инструкцию для собственников недвижимости, что&nbsp;обязательно сделать</p>
        <p class="danger">до 01&nbsp;января 2027&nbsp;года</p>
      </h1>
      <h2 class="lead">
        <p>Почему нужна инструкция? В&nbsp;правительстве призвали</p>
        <a href="https://vk.com/wall-143818234_493082?ysclid=mn04gu8c47936628106" target="_blank">
          резко поднять кадастровую стоимость
        </a>
        <p>всей недвижимости в стране для увеличения налоговых сборов</p>
        <button @click="isModalOpen = true" class="get-instructions-button">Получить инструкцию</button>
      </h2>

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

    <div v-if="isModalOpen" class="modal-overlay" @click.self="isModalOpen = false">
      <div class="modal-content">
        <h3>Получить инструкцию</h3>
        <p>Введите номер телефона, и мы отправим вам файл</p>

        <form @submit.prevent="submitForm">
          <input
              v-model="phone"
              v-maska
              data-maska="+7 (###) ###-##-##"
              type="tel"
              placeholder="+7 (999) 000-00-00"
              required
              :class="{ 'input-error': vError }"
          />
          <p v-if="vError" class="error-msg">{{ vError }}</p>

          <button type="submit" :disabled="isSending || !isPhoneComplete" class="btn-submit">
            {{ isSending ? 'Отправка...' : 'Отправить' }}
          </button>
        </form>

        <button @click="isModalOpen = false" class="btn-close">✕</button>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, computed } from 'vue';
import { vMaska } from "maska/vue"; // Импортируем директиву

const isModalOpen = ref(false);
const phone = ref('');
const isSending = ref(false);
const vError = ref('');

// Проверка: заполнен ли номер полностью (11 цифр с учетом +7)
const isPhoneComplete = computed(() => {
  return phone.value.replace(/\D/g, '').length === 11;
});

const submitForm = async () => {
  if (!isPhoneComplete.value) {
    vError.value = 'Введите полный номер телефона';
    return;
  }

  vError.value = '';
  isSending.value = true;

  try {
    const response = await fetch('../send-mail.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      // Отправляем чистые цифры или форматированную строку — на ваш вкус
      body: JSON.stringify({
        phone: phone.value,
        rawPhone: phone.value.replace(/\D/g, ''),
        type: 'instruction_request'
      })
    });

    if (response.ok) {
      alert('Инструкция успешно заказана!');
      isModalOpen.value = false;
      phone.value = '';
    } else {
      throw new Error();
    }
  } catch (err) {
    alert('Ошибка при отправке. Попробуйте позже.');
  } finally {
    isSending.value = false;
  }
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

.danger {
  color: red;
}

a {
  text-decoration: none;
  color: #1e40af
}

.get-instructions-button {
  background: rgba(30, 64, 175, 0.05);
  border-radius: 12px;
  border: 1px solid rgba(30, 64, 175, 0.2);
  padding: 10px 24px;
  margin-top: 15px;
  cursor: pointer;
  color: #1e40af;
  font-weight: 600;
  font-size: 1rem;
  transition: all 0.3s ease;
}

.get-instructions-button:hover {
  background: rgba(30, 64, 175, 0.1);
  border-color: #1e40af;
  transform: translateY(-1px);
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

.modal-overlay {
  position: fixed;
  top: 0; left: 0; width: 100%; height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.modal-content {
  background: white;
  padding: 30px;
  border-radius: 15px;
  position: relative;
  width: 90%;
  max-width: 400px;
  text-align: center;
}

.modal-content input {
  width: 100%;
  padding: 12px;
  margin: 15px 0 5px;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 16px;
}

.input-error { border-color: red !important; }
.error-msg { color: red; font-size: 12px; margin-bottom: 10px; }

.btn-submit {
  background: #1e40af;
  color: white;
  border: none;
  padding: 12px 20px;
  border-radius: 8px;
  cursor: pointer;
  width: 100%;
  font-weight: 600;
}

.btn-submit:disabled { opacity: 0.6; }

.btn-close {
  position: absolute;
  top: 10px; right: 10px;
  background: none; border: none; font-size: 20px; cursor: pointer;
}

@media (max-width: 768px) {
  h1 { font-size: 28px; }
  .hero { padding: 40px 0; }
  .hero-content { max-width: 95%; }
}
</style>