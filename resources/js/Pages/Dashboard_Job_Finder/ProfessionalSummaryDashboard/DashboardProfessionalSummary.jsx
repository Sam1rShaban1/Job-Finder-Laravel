import React, { useState } from 'react';
import { router } from '@inertiajs/react';
import DashboardLayout from "../DashboardLayout";
import Sidebar from "../DashboardSideBar";

const DashboardProfessionalSummary = ({ summary }) => {
    const [isEditing, setIsEditing] = useState(false);
    const [formData, setFormData] = useState({
        summary: summary || ''
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        router.put(route('professional.summary.update', {}), formData, {
            onSuccess: () => setIsEditing(false)
        });
    };

    return (
        <>
        <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div className="p-6">
                <div className="flex justify-between items-center mb-6">
                    <h2 className="text-2xl font-bold text-gray-800">Professional Summary</h2>
                    <button
                        onClick={() => setIsEditing(!isEditing)}
                        className="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-200"
                    >
                        {isEditing ? 'Cancel' : 'Edit'}
                    </button>
                </div>

                {isEditing ? (
                    <form onSubmit={handleSubmit} className="space-y-4">
                        <textarea
                            value={formData.summary}
                            onChange={(e) => setFormData({ summary: e.target.value })}
                            className="w-full p-4 border rounded-md h-48 focus:ring-2 focus:ring-blue-500"
                            placeholder="Write your professional summary..."
                        />
                        <button
                            type="submit"
                            className="px-6 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition duration-200"
                        >
                            Save Changes
                        </button>
                    </form>
                ) : (
                    <div className="bg-gray-50 p-4 rounded-md">
                        <p className="text-gray-700 whitespace-pre-wrap">
                            {formData.summary || 'No professional summary added yet.'}
                        </p>
                    </div>
                )}
            </div>
        </div>
        </>
    );
};

DashboardProfessionalSummary.layout = (page) => (
    <DashboardLayout fluid>
        <div className="min-h-screen flex">
            <Sidebar activePage="Professional Summary" />
            <div className="flex-1 p-8">
                {page}
            </div>
        </div>
    </DashboardLayout>
);

export default DashboardProfessionalSummary; 