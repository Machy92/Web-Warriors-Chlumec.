<footer class="footer">
  <div class="footer-container">
    <!-- Logo nahoře -->
    <div class="footer-logo">
      <img src="chlumeclogo.png" alt="Warriors Logo">
    </div>

    <!-- Kontakt a odkazy -->
    <div class="footer-links">
      <div class="footer-contact">
        <p>Kontakt: <a href="mailto:info@warriorschlumec.cz" class="hover-effect">info@warriorschlumec.cz</a> | Tel: +420 123 456 789</p>
      </div>
      <div class="footer-socials">
        <a href="https://www.facebook.com/people/HS%C3%9A-SHC-Warriors-Chlumec/100069910536674/" target="_blank" class="hover-effect">
          <i class="fab fa-facebook-f"></i> Facebook
        </a>
        <a href="https://www.instagram.com/warriorschlumec/" target="_blank" class="hover-effect">
          <i class="fab fa-instagram"></i> Instagram
        </a>
      </div>
    </div>

    <!-- Spodní část -->
    <div class="footer-bottom">
      <p>&copy; 2024 Warriors Chlumec. Všechna práva vyhrazena.</p>
    </div>
  </div>
</footer>

<style>
/* Footer */
.footer {
    background: linear-gradient(90deg, #d32f2f, #ff6e6e); /* Stejný gradient jako header */
    color: #fff;
    padding: 15px 15px; /* Další zmenšení paddingu */
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    position: relative;
    font-size: 12px; /* Ještě menší velikost písma */
}

/* Container */
.footer-container {
    max-width: 1200px;
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px; /* Další zmenšení mezery mezi prvky */
}

/* Logo */
.footer-logo {
    margin-bottom: 8px; /* Zmenšení mezery mezi logem a zbytkem */
}
.footer-logo img {
    max-width: 70px; /* Ještě menší logo */
    height: auto;
    opacity: 0.9;
    transition: transform 0.3s ease, opacity 0.3s ease;
}
.footer-logo img:hover {
    opacity: 1;
    transform: scale(1.05); /* Zmenšení efektu při hoveru */
}

/* Kontakt a sociální sítě */
.footer-contact a {
    color: #fff;
    text-decoration: none;
    transition: all 0.3s ease;
}

.footer-contact a:hover {
    color: #ff6e6e; /* Světlejší červená při hoveru */
    transform: translateY(-1px); /* Mírnější pohyb */
}
.footer-links {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 6px; /* Další zmenšení mezery mezi odkazy */
}
.footer-socials {
    display: flex;
    gap: 12px; /* Další zmenšení mezery mezi ikonkami */
    justify-content: center;
}
.footer-socials a {
    font-size: 12px; /* Ještě menší velikost písma u odkazů */
    font-weight: bold;
    color: #fff;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 6px; /* Menší mezera mezi ikonou a textem */
    transition: all 0.3s ease;
}
.footer-socials a:hover {
    color: #ff6e6e; /* Světlejší červená při hoveru */
    transform: translateY(-1px); /* Mírnější pohyb */
}

/* Spodní text */
.footer-bottom {
    font-size: 10px; /* Ještě menší velikost písma */
    border-top: 1px solid rgba(255, 255, 255, 0.3);
    padding-top: 8px; /* Ještě menší padding */
    margin-top: 12px; /* Mírné zmenšení mezery */
    width: 100%;
    text-align: center;
}

/* Responsivita */
@media (max-width: 768px) {
    .footer-socials {
        flex-direction: column;
        gap: 8px;
    }
}
</style>

<!-- Font Awesome pro ikony -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
