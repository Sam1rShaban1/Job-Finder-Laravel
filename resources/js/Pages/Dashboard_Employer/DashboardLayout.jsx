import React from 'react';
import NavBar from '../NavBar/NavBar';

const DashboardLayout = ({ children }) => {
    return (
        <div>
            <NavBar />
            <div className="min-h-screen bg-gray-100">
                <div className="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                    <div className="px-4 py-6 sm:px-0">
                        {children}
                    </div>
                </div>
            </div>
        </div>
    );
};

export default DashboardLayout; 