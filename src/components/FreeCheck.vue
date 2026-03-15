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

      <button
          v-if="!isFormVisible"
          class="btn-white"
          @click="toggleForm"
      >
        Проверить объект
      </button>

      <transition name="form-slide">
        <div v-if="isFormVisible" class="form-wrapper">
          <form
              class="check-form"
              @submit.prevent="handleSubmit"
          >
            <button type="button" class="form-close" @click="toggleForm" aria-label="Закрыть">
              &#x2715;
            </button>

            <h3 class="form-title">Заполните данные для проверки</h3>

            <transition name="fade">
              <div v-if="submitStatus === 'success'" class="success-message">
                <div class="success-icon">✓</div>
                <h4>Заявка отправлена!</h4>
                <p>Мы свяжемся с вами в ближайшее время</p>
              </div>
            </transition>

            <transition name="fade">
              <div v-if="submitStatus === 'error'" class="error-message">
                <div class="error-icon">!</div>
                <h4>Ошибка отправки</h4>
                <p>Попробуйте ещё раз или позвоните нам</p>
              </div>
            </transition>

            <div v-show="submitStatus !== 'success'">
              <div class="form-group">
                <label for="address">Адрес объекта или кадастровый номер</label>
                <input
                    type="text"
                    id="address"
                    name="address"
                    v-model="formData.address"
                    placeholder="Например: ул. Ленина 1, кв. 5"
                    required
                    :disabled="isSubmitting"
                >
              </div>

              <div class="form-group">
                <label for="phone">Телефон</label>
                <input
                    type="tel"
                    id="phone"
                    name="phone"
                    v-model="formData.phone"
                    placeholder="+7 (___) ___-__-__"
                    required
                    :disabled="isSubmitting"
                >
              </div>

              <div class="form-group">
                <label for="email">Адрес электронной почты (необязательно)</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    v-model="formData.email"
                    placeholder="example@mail.ru"
                    :disabled="isSubmitting"
                >
              </div>

              <div class="form-agreement">
                <input
                    type="checkbox"
                    id="agreement"
                    name="agreement"
                    v-model="formData.agreement"
                    required
                    :disabled="isSubmitting"
                >
                <label for="agreement">Согласен на обработку персональных данных</label>
              </div>

              <button type="submit" class="btn-submit" :disabled="isSubmitting">
                {{ isSubmitting ? 'Отправка...' : 'Отправить заявку' }}
              </button>
            </div>
          </form>
        </div>
      </transition>
    </div>
  </section>
</template>

<script setup>
import { ref, reactive } from 'vue';

const helpItems = [
  'Проверить актуальность данных недвижимости',
  'Выявить возможные ошибки',
  'Объяснить, нужно ли подавать декларацию',
  'Предоставить пошаговую инструкцию'
];

const isFormVisible = ref(false);
const isSubmitting = ref(false);
const submitStatus = ref(null); // 'success' | 'error' | null

const formData = reactive({
  address: '',
  phone: '',
  email: '',
  agreement: false
});

const toggleForm = () => {
  isFormVisible.value = !isFormVisible.value;
  if (!isFormVisible.value) {
    setTimeout(() => {
      submitStatus.value = null;
      formData.address = '';
      formData.phone = '';
      formData.email = '';
      formData.agreement = false;
    }, 300);
  }
};

const handleSubmit = async () => {
  isSubmitting.value = true;
  submitStatus.value = null;

  try {
    const data = new FormData();
    data.append('address', formData.address);
    data.append('phone', formData.phone);
    data.append('email', formData.email);
    data.append('agreement', formData.agreement ? '1' : '0');

    const response = await fetch('../send-mail.php', {
      method: 'POST',
      body: data
    });

    if (response.ok) {
      const result = await response.json();

      if (result.success) {
        submitStatus.value = 'success';
        formData.address = '';
        formData.phone = '';
        formData.email = '';
        formData.agreement = false;
      } else {
        throw new Error(result.message || 'Ошибка отправки');
      }
    } else {
      throw new Error('Ошибка сервера');
    }
  } catch (error) {
    console.error('Ошибка отправки:', error);
    submitStatus.value = 'error';
  } finally {
    isSubmitting.value = false;
  }
};
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

.form-wrapper {
  width: 100%;
  max-width: 500px;
  margin: 0 auto;
}

.check-form {
  background: white;
  color: var(--text-main);
  padding: 40px 30px;
  border-radius: 16px;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
  position: relative;
  text-align: left;
}

.form-close {
  position: absolute;
  top: 15px;
  right: 15px;
  background: none;
  border: none;
  font-size: 24px;
  cursor: pointer;
  color: var(--text-secondary);
  width: 32px;
  height: 32px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  transition: background-color 0.2s;
}

.form-close:hover {
  background-color: #f3f4f6;
  color: var(--text-main);
}

.form-title {
  font-size: 22px;
  margin-bottom: 24px;
  text-align: center;
  color: var(--text-main);
}

.success-message,
.error-message {
  padding: 30px 20px;
  text-align: center;
}

.success-icon {
  width: 60px;
  height: 60px;
  background-color: #10b981;
  color: white;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 32px;
  margin: 0 auto 20px;
}

.error-icon {
  width: 60px;
  height: 60px;
  background-color: #ef4444;
  color: white;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 32px;
  margin: 0 auto 20px;
}

.success-message h4,
.error-message h4 {
  font-size: 20px;
  margin-bottom: 10px;
  color: var(--text-main);
}

.success-message p,
.error-message p {
  color: var(--text-secondary);
}

.form-group {
  margin-bottom: 20px;
}

.form-group label {
  display: block;
  margin-bottom: 8px;
  font-weight: 500;
  font-size: 14px;
  color: var(--text-secondary);
}

.form-group input {
  width: 100%;
  padding: 12px 16px;
  border: 2px solid #e5e7eb;
  border-radius: 8px;
  font-size: 16px;
  transition: border-color 0.2s, box-shadow 0.2s;
  box-sizing: border-box;
}

.form-group input:focus {
  outline: none;
  border-color: var(--primary-color);
  box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.form-group input:disabled {
  background-color: #f3f4f6;
  cursor: not-allowed;
}

.form-agreement {
  display: flex;
  align-items: flex-start;
  gap: 10px;
  margin-bottom: 24px;
  font-size: 13px;
  color: var(--text-secondary);
}

.form-agreement input[type="checkbox"] {
  margin-top: 3px;
  flex-shrink: 0;
}

.btn-submit {
  width: 100%;
  background-color: var(--primary-color);
  color: white;
  padding: 14px 24px;
  border-radius: 8px;
  font-weight: 600;
  font-size: 16px;
  border: none;
  cursor: pointer;
  transition: background-color 0.2s;
}

.btn-submit:hover {
  background-color: var(--primary-hover);
}

.btn-submit:disabled {
  background-color: #9ca3af;
  cursor: not-allowed;
}

/* Анимации */
.form-slide-enter-active,
.form-slide-leave-active {
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.form-slide-enter-from {
  opacity: 0;
  transform: translateY(-30px) scale(0.95);
}

.form-slide-enter-to {
  opacity: 1;
  transform: translateY(0) scale(1);
}

.form-slide-leave-from {
  opacity: 1;
  transform: translateY(0) scale(1);
}

.form-slide-leave-to {
  opacity: 0;
  transform: translateY(-30px) scale(0.95);
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

@media (max-width: 768px) {
  .cta-grid { grid-template-columns: 1fr; text-align: center; }
  .help-list ul { padding: 0; display: inline-block; text-align: left; }

  .check-form {
    padding: 30px 20px;
  }

  h2 { font-size: 28px; }
}
</style>