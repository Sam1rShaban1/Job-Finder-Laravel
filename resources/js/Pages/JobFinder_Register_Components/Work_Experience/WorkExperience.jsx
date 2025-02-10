import React, { useState } from "react";
import NavBar from "../../NavBar/NavBar";
import { router } from "@inertiajs/react";

const WorkExperience = ({ experiences = [] }) => {
  const [jobs, setJobs] = useState([]);
  const [editingIndex, setEditingIndex] = useState(null);
  const [formData, setFormData] = useState({
    company_name: '',
    position: '',
    start_date: '',
    end_date: '',
    description: ''
  });

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value
    });
  };

  const handleAddMore = (e) => {
    e.preventDefault();
    if (!formData.company_name || !formData.position) return;

    setJobs([...jobs, formData]);
    setFormData({
      company_name: '',
      position: '',
      start_date: '',
      end_date: '',
      description: ''
    });
  };

  const handleDelete = (index) => {
    const updatedJobs = jobs.filter((_, i) => i !== index);
    setJobs(updatedJobs);
  };

  const handleEdit = (index) => {
    setEditingIndex(index);
    setFormData(jobs[index]);
  };

  const handleSkip = () => {
    router.visit(route('skill'));
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    
    // If there are saved jobs, submit them all
    if (jobs.length > 0) {
      jobs.forEach(job => {
        router.post(route('work.experience.store'), job);
      });
    }
    
    // If there's data in the form, submit that too
    if (formData.company_name && formData.position) {
      router.post(route('work.experience.store'), formData);
    }

    router.visit(route('skill'));
  };

  return (
    <div>
      <NavBar />
      <div className="min-h-screen flex items-start justify-center bg-gray-100 p-8">
        <div className={`flex w-full max-w-7xl gap-8 ${jobs.length > 0 ? 'flex-row' : 'flex-col'}`}>
          {/* Form Section */}
          <div className={jobs.length > 0 ? 'w-1/2' : 'w-full max-w-2xl mx-auto'}>
            <main className="bg-white p-8 rounded-lg shadow-md">
              <h2 className="text-2xl font-bold text-blue-500 text-center mb-6">
                Work Experience
              </h2>
              <form onSubmit={handleSubmit} className="flex flex-col gap-4">
                <div>
                  <label htmlFor="position" className="block text-sm font-medium text-gray-700">
                    Title:
                  </label>
                  <input
                    type="text"
                    id="position"
                    name="position"
                    value={formData.position}
                    onChange={handleChange}
                    className="w-full p-2 border border-gray-300 rounded-md"
                  />
                </div>
                <div>
                  <label htmlFor="company_name" className="block text-sm font-medium text-gray-700">
                    Company:
                  </label>
                  <input
                    type="text"
                    id="company_name"
                    name="company_name"
                    value={formData.company_name}
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
                  <label htmlFor="description" className="block text-sm font-medium text-gray-700">
                    Description:
                  </label>
                  <textarea
                    id="description"
                    name="description"
                    value={formData.description}
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
                  Skip if no work experience
                </button>
              </form>
            </main>
          </div>

          {/* Saved Experiences Section - Only shows when there are jobs */}
          {jobs.length > 0 && (
            <div className="w-1/2">
              <div className="space-y-4">
                {jobs.map((job, index) => (
                  <div key={index} className="bg-white p-6 rounded-lg shadow-md">
                    <h3 className="text-lg font-bold text-gray-800">{job.position}</h3>
                    <p className="text-gray-600">{job.company_name}</p>
                    <p className="text-sm text-gray-500">
                      {job.start_date} - {job.end_date || 'Present'}
                    </p>
                    <p className="mt-2 text-gray-700">{job.description}</p>
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

export default WorkExperience;