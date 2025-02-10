import React from "react";
import "./Footer.css";

const Footer = () => {
  return (
    <footer className="footer">
      <div className="footer-content">
        <div className="contact-details">
          <a href="#contact"><h3  className="contact-title">Contact</h3></a>
          <p>Location: Tetovo</p>
          <p>Phone: +389 71 111 111</p>
          <p>Email: info@macedoniajob.com</p>
        </div>
        <div className="social-icons">
        <div className="social-icons">
  <a href="#instagram" className="icon-link">
    <i className="bi bi-instagram"></i>
  </a>
  <a href="#facebook" className="icon-link">
    <i className="bi bi-facebook"></i>
  </a>
  <a href="#email" className="icon-link">
    <i className="bi bi-envelope"></i>
  </a>
</div>
        </div>
      </div>
      <div className="footer-bottom">
        <p>© Copyright MacedoniaJob. All rights reserved</p>
      </div>
    </footer>
  );
};

export default Footer;