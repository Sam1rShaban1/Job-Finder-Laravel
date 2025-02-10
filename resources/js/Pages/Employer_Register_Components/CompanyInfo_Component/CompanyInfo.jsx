import React from 'react';
import { router } from '@inertiajs/react';
import './CompanyInfo.css';
import NavBar from '../../NavBar/NavBar';

const CompanyInfo = () => {
    const handleSubmit = (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);
        
        router.post(route('company.info.store'), formData, {
            onSuccess: () => {
                router.visit(route('employer.account.success'));
            }
        });
    };

    return (
        <div>
            <NavBar />
            
            <div className="company-info-container">
                <main className="form-container">
                    <h2 className="form-title">Company Information</h2>
                    <form className="company-info-form" onSubmit={handleSubmit}>
                        <label htmlFor="companyname" className="form-label">Company Name:</label>
                        <input type="text" id="companyname" name="companyname" className="form-input" required />

                        <label htmlFor="companyoverview" className="form-label">Company Overview:</label>
                        <textarea id="companyoverview" name="companyoverview" className="form-input" required />

                        <label htmlFor="companyculture" className="form-label">Company Culture:</label>
                        <textarea id="companyculture" name="companyculture" className="form-input" required />

                        <label htmlFor="companywebsite" className="form-label">Company Website:</label>
                        <input type="url" id="companywebsite" name="companywebsite" className="form-input" required />
  
                        <label htmlFor="address" className="form-label">Address:</label>
                        <input type="text" id="address" name="address" className="form-input" required />

                        <label htmlFor="companylogo" className="form-label">Company Logo:</label>
                        <input type="file" id="companylogo" name="companylogo" className="form-input" required />

                        <button type="submit" className="form-button">Save & Next</button>
                    </form>

                </main>
            </div>
        </div>
    );
};

export default CompanyInfo;
