import React, { useState } from "react";
import NavBar from "../../NavBar/NavBar";
import { router } from "@inertiajs/react";

const Education = () => {
    const [educations, setEducations] = useState([]);
    const [editingIndex, setEditingIndex] = useState(null);
    const [formData, setFormData] = useState({
        degree: '',
        institution: '',
        start_date: '',
        end_date: '',
        coursework: ''
    });

    const handleChange = (e) => {
        setFormData({
            ...formData,
            [e.target.name]: e.target.value
        });
    };

    const handleAddMore = (e) => {
        e.preventDefault();
        if (!formData.degree || !formData.institution) return;

        setEducations([...educations, formData]);
        setFormData({
            degree: '',
            institution: '',
            start_date: '',
            end_date: '',
            coursework: ''
        });
    };

    const handleDelete = (index) => {
        const updatedEducations = educations.filter((_, i) => i !== index);
        setEducations(updatedEducations);
    };

    const handleEdit = (index) => {
        setEditingIndex(index);
        setFormData(educations[index]);
    };

    const handleSkip = () => {
        router.visit(route('certification'));
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        
        // If there are saved educations, submit them all
        if (educations.length > 0) {
            educations.forEach(edu => {
                router.post(route('education.store'), edu);
            });
        }
        
        // If there's data in the form, submit that too
        if (formData.degree && formData.institution) {
            router.post(route('education.store'), formData);
        }

        router.visit(route('certification'));
    };

    return (
        <div>
            <NavBar />
            <div className="min-h-screen flex items-start justify-center bg-gray-100 p-8">
                <div className={`flex w-full max-w-7xl gap-8 ${educations.length > 0 ? 'flex-row' : 'flex-col'}`}>
                    {/* Form Section */}
                    <div className={educations.length > 0 ? 'w-1/2' : 'w-full max-w-2xl mx-auto'}>
                        <main className="bg-white p-8 rounded-lg shadow-md">
                            <h2 className="text-2xl font-bold text-blue-500 text-center mb-6">
                                Education
                            </h2>
                            <form onSubmit={handleSubmit} className="flex flex-col gap-4">
                                <div>
                                    <label htmlFor="degree" className="block text-sm font-medium text-gray-700">
                                        Degree:
                                    </label>
                                    <input
                                        type="text"
                                        id="degree"
                                        name="degree"
                                        value={formData.degree}
                                        onChange={handleChange}
                                        className="w-full p-2 border border-gray-300 rounded-md"
                                    />
                                </div>

                                <div>
                                    <label htmlFor="institution" className="block text-sm font-medium text-gray-700">
                                        Institution:
                                    </label>
                                    <input
                                        type="text"
                                        id="institution"
                                        name="institution"
                                        value={formData.institution}
                                        onChange={handleChange}
                                        className="w-full p-2 border border-gray-300 rounded-md"
                                    />
                                </div>

                                <div>
                                    <label htmlFor="start_date" className="block text-sm font-medium text-gray-700">
                                        Start Date:
                                    </label>
                                    <input
                                        type="date"
                                        id="start_date"
                                        name="start_date"
                                        value={formData.start_date}
                                        onChange={handleChange}
                                        className="w-full p-2 border border-gray-300 rounded-md"
                                    />
                                </div>

                                <div>
                                    <label htmlFor="end_date" className="block text-sm font-medium text-gray-700">
                                        End Date:
                                    </label>
                                    <input
                                        type="date"
                                        id="end_date"
                                        name="end_date"
                                        value={formData.end_date}
                                        onChange={handleChange}
                                        className="w-full p-2 border border-gray-300 rounded-md"
                                    />
                                </div>

                                <div>
                                    <label htmlFor="coursework" className="block text-sm font-medium text-gray-700">
                                        Coursework:
                                    </label>
                                    <textarea
                                        id="coursework"
                                        name="coursework"
                                        value={formData.coursework}
                                        onChange={handleChange}
                                        className="w-full p-2 border border-gray-300 rounded-md"
                                        rows="3"
                                    />
                                </div>

                                <div className="flex gap-4">
                                    <button
                                        type="button"
                                        onClick={handleAddMore}
                                        className="flex-1 py-3 bg-gray-500 text-white font-bold rounded-md hover:bg-gray-600 transition duration-200"
                                    >
                                        Save & Add More
                                    </button>
                                    <button
                                        type="submit"
                                        className="flex-1 py-3 bg-black text-white font-bold rounded-md hover:bg-gray-800 transition duration-200"
                                    >
                                        Save & Next
                                    </button>
                                </div>
                                <button
                                    type="button"
                                    onClick={handleSkip}
                                    className="py-2 text-gray-600 hover:text-gray-800 transition duration-200 text-center"
                                >
                                    Skip if no education
                                </button>
                            </form>
                        </main>
                    </div>

                    {/* Saved Education Section */}
                    {educations.length > 0 && (
                        <div className="w-1/2">
                            <div className="space-y-4">
                                {educations.map((edu, index) => (
                                    <div key={index} className="bg-white p-6 rounded-lg shadow-md">
                                        <h3 className="text-lg font-bold text-gray-800">{edu.degree}</h3>
                                        <p className="text-gray-600">{edu.institution}</p>
                                        <p className="text-sm text-gray-500">
                                            {edu.start_date} - {edu.end_date || 'Present'}
                                        </p>
                                        <p className="mt-2 text-gray-700">{edu.coursework}</p>
                                        <div className="flex gap-2 mt-4">
                                            <button
                                                onClick={() => handleEdit(index)}
                                                className="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-200"
                                            >
                                                Edit
                                            </button>
                                            <button
                                                onClick={() => handleDelete(index)}
                                                className="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition duration-200"
                                            >
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        </div>
                    )}
                </div>
            </div>
        </div>
    );
};

export default Education;