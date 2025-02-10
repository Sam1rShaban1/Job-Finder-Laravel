import React from "react";
import { router } from '@inertiajs/react';
import "./ProfessionalSummary.css";
import NavBar from "../../NavBar/NavBar";

const ProfessionalSummary = () => {
  const handleSubmit = (e) => {
    e.preventDefault();
    router.post(route('professional.summary.store'), {
      summary: e.target.summary.value
    });
  };

  return (
    <div>
      <NavBar />
      <div className="professional-summary-container">
        <main className="form-container">
          <h2 className="form-title">Professional Summary</h2>
          <form className="summary-form" onSubmit={handleSubmit}>
            <textarea
              name="summary"
              className="form-textarea"
              placeholder="Write your professional summary here..."
              required
            ></textarea>
            <button type="submit" className="form-button">Save & Next</button>
          </form>
        </main>
      </div>
    </div>
  );
};

export default ProfessionalSummary;