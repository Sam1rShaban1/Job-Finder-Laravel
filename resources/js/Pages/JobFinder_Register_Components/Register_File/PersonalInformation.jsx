import React, { useState } from 'react';
import { router } from '@inertiajs/react';
import './PersonalInformation.css';
import NavBar from '../../NavBar/NavBar';

const PersonalInformation = () => {
    const [role, setRole] = useState('');
    const [formData, setState] = useState({
        // your form state here
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        const formData = {
            fullname: e.target.fullname.value,
            email: e.target.email.value,
            password: e.target.password.value,
            address: e.target.address.value,
            role: role
        };

        router.post(route('personal.information.store'), formData, {
            preserveScroll: true,
            onError: (errors) => {
                console.error(errors);
            }
        });
    };

    return (
        <div>
            <NavBar />
            
            <div className="personal-info-container">
                <main className="form-container">
                    <h2 className="form-title">Personal Information</h2>
                    <form className="personal-info-form" onSubmit={handleSubmit}>
                        <label htmlFor="fullname" className="form-label">Full Name:</label>
                        <input type="text" id="fullname" name="fullname" className="form-input" required />
  
                        <label htmlFor="email" className="form-label">Email:</label>
                        <input type="email" id="email" name="email" className="form-input" required />
  
                        <label htmlFor="password" className="form-label">Password:</label>
                        <input type="password" id="password" name="password" className="form-input" required />
  
                        <label htmlFor="address" className="form-label">Address:</label>
                        <input type="text" id="address" name="address" className="form-input" required />
  
                        <label htmlFor="role" className="form-label">Role:</label>
                        <select id="role" name="role" className="form-select" value={role} onChange={(e) => setRole(e.target.value)} required>
                          <option value="">Select Role</option>
                          <option value="employer">Employer</option>
                          <option value="job-seeker">Job Seeker</option>
                        </select>
  
                        <button type="submit" className="form-button">Save & Next</button>
                    </form>
                </main>
            </div>
        </div>
    );
};

export default PersonalInformation;
