import React, { useState } from "react";
import { router } from "@inertiajs/react";
import NavBar from "../../NavBar/NavBar";

const Skills = () => {
    const [skills, setSkills] = useState([]);
    const [formData, setFormData] = useState({
        name: '',
        proficiency: 'Junior'
    });

    const handleChange = (e) => {
        setFormData({
            ...formData,
            [e.target.name]: e.target.value
        });
    };

    const handleAddMore = () => {
        if (!formData.name.trim()) {
            alert("Skill name cannot be empty.");
            return;
        }
    
        setSkills((prevSkills) => [...prevSkills, { ...formData }]); // ✅ Correctly updating state
        setFormData({ name: '', proficiency: 'Junior' }); // Reset form
    };

    const handleSubmit = (e) => {
        e.preventDefault();
    
        if (skills.length === 0) {
            alert("Please add at least one skill before saving.");
            return;
        }
    
        // Using a callback to ensure the latest state is used
        setSkills((prevSkills) => {
            if (prevSkills.length === 0) {
                alert("Please add at least one skill before saving.");
                return prevSkills;
            }
    
            router.post(route('skills.store'), { skills: prevSkills }, {
                preserveState: true,
                onSuccess: () => {
                    router.visit(route('education'));
                },
                onError: (errors) => {
                    console.error("Error saving skills:", errors);
                }
            });
    
            return prevSkills;
        });
    };

    return (
        <div>
            <NavBar />
            <div className="min-h-screen flex items-center justify-center bg-gray-100">
                <main className="bg-white w-full max-w-md p-8 rounded-lg shadow-md">
                    <h2 className="text-2xl font-bold text-blue-500 text-center mb-6">
                        Skills
                    </h2>
                    <form onSubmit={handleSubmit} className="flex flex-col gap-4">
                        {/* Skill Name Input */}
                        <div>
                            <label htmlFor="name" className="block text-sm font-medium text-gray-700">
                                Skill Name:
                            </label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value={formData.name}
                                onChange={handleChange}
                                className="w-full p-2 border border-gray-300 rounded-md"
                            />
                        </div>

                        {/* Proficiency Level Dropdown */}
                        <div>
                            <label htmlFor="proficiency" className="block text-sm font-medium text-gray-700">
                                Proficiency Level:
                            </label>
                            <select
                                id="proficiency"
                                name="proficiency"
                                value={formData.proficiency}
                                onChange={handleChange}
                                className="w-full p-2 border border-gray-300 rounded-md"
                            >
                                <option value="Junior">Junior</option>
                                <option value="Intermediate">Intermediate</option>
                                <option value="Senior">Senior</option>
                            </select>
                        </div>

                        {/* Buttons */}
                        <div className="flex gap-4">
                            <button
                                type="button"
                                onClick={handleAddMore}
                                className="flex-1 py-3 bg-gray-500 text-white font-bold rounded-md hover:bg-gray-600"
                            >
                                Add More
                            </button>
                            <button
                                type="submit"
                                className="flex-1 py-3 bg-black text-white font-bold rounded-md hover:bg-gray-800"
                            >
                                Save & Next
                            </button>
                        </div>
                    </form>

                    {/* Display Added Skills */}
                    <div className="mt-4">
                        {skills.length > 0 ? (
                            skills.map((skill, index) => (
                                <div key={index} className="bg-gray-100 p-3 rounded mb-2">
                                    <p>{skill.name} - <strong>{skill.proficiency}</strong></p>
                                </div>
                            ))
                        ) : (
                            <p className="text-center text-gray-500">No skills added yet.</p>
                        )}
                    </div>
                </main>
            </div>
        </div>
    );
};

export default Skills;