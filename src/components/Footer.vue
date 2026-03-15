<template>
  <footer class="footer" id="contacts">
    <div class="container">
      <h2>Остались вопросы?</h2>

      <div class="footer-content">
        <p class="desc">
          Свяжитесь с&nbsp;нами. Специалисты помогут проверить данные объекта&nbsp;и подскажут дальнейшие действия.
        </p>

        <div class="contacts">
          <a href="tel:+79604993376" class="contact-item">
            <span>📞</span> +7&nbsp;(960)&nbsp;499-33-76
          </a>
          <a target="_blank" href="mailto:adm@fzkadastr.ru" class="contact-item">
            <span>✉️</span> adm@fzkadastr.ru
          </a>
          <a target="_blank" href="https://t.me/obuchenie_lider" class="contact-item">
            <img class="tg-logo" alt="tg-image" src="../assets/tg-logo.png"> @obuchenie_lider
          </a>
        </div>
      </div>

      <div class="copyright">
        &copy 2026 Общество с ограниченной ответственностью "Лидер". Все права защищены.
      </div>
    </div>
  </footer>
</template>

<style scoped>
.footer {
  background-color: #111827;
  color: #9ca3af;
  padding: 60px 0 30px;
}

h2 { color: white; font-size: 28px; margin-bottom: 30px; }

.footer-content {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 40px;
  flex-wrap: wrap;
  gap: 30px;
}

.desc { max-width: 400px; font-size: 16px; }

.contacts { display: flex; flex-direction: column; gap: 15px; }

.contact-item {
  color: white;
  text-decoration: none;
  font-size: 18px;
  display: flex;
  align-items: center;
  gap: 10px;
  transition: color 0.2s;
}

.contact-item:hover { color: var(--primary-color); }

.tg-logo {
  width: 25px;
  border-radius: 50%;
}

.copyright {
  border-top: 1px solid #374151;
  padding-top: 20px;
  text-align: center;
  font-size: 14px;
}

@media (max-width: 768px) {
  .footer-content { flex-direction: column; }
}
</style>