import React, { useState } from "react";
import { router } from "@inertiajs/react";
import NavBar from "../../NavBar/NavBar";
import Sidebar from "../DashboardSideBar";

const WorkExperienceDashboard = ({ experiences = [] }) => {
  const [isEditing, setIsEditing] = useState(false);
  const [editingId, setEditingId] = useState(null);
  const [formData, setFormData] = useState({
    company_name: '',
    position: '',
    start_date: '',
    end_date: '',
    description: ''
  });

  const handleEdit = (experience) => {
    setFormData(experience);
    setEditingId(experience.id);
    setIsEditing(true);
  };

  const handleDelete = (id) => {
    if (confirm('Are you sure you want to delete this experience?')) {
      router.delete(route('work-experiences.destroy', id), {
        preserveScroll: true
      });
    }
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    const url = editingId 
      ? route('work-experiences.update', editingId)
      : route('work-experiences.store');
    
    const method = editingId ? 'put' : 'post';

    router[method](url, formData, {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => {
        setIsEditing(false);
        setEditingId(null);
      }
    });
  };

  return (
    <>
      <NavBar userName="JobFinder's Name" />
      <div className="min-h-screen flex bg-gray-100">
        <Sidebar activePage="Work Experience" />
        <div className="flex-1 p-8">
          <div className="max-w-4xl mx-auto">
            <h2 className="text-2xl font-bold text-blue-500 mb-6">Work Experience</h2>
            <hr className="mb-6" />

            <button
              onClick={() => setIsEditing(true)}
              className="mb-6 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-200"
            >
              + Add Experience
            </button>

            {isEditing && (
              <div className="bg-white p-6 rounded-lg shadow-md mb-6">
                <form onSubmit={handleSubmit} className="space-y-4">
                  <div>
                    <label className="block text-sm font-medium text-gray-700">Position</label>
                    <input
                      type="text"
                      value={formData.position}
                      onChange={(e) => setFormData({ ...formData, position: e.target.value })}
                      className="w-full p-2 border rounded-md"
                    />
                  </div>
                  <div>
                    <label className="block text-sm font-medium text-gray-700">Company</label>
                    <input
                      type="text"
                      value={formData.company_name}
                      onChange={(e) => setFormData({ ...formData, company_name: e.target.value })}
                      className="w-full p-2 border rounded-md"
                    />
                  </div>
                  <div className="grid grid-cols-2 gap-4">
                    <div>
                      <label className="block text-sm font-medium text-gray-700">Start Date</label>
                      <input
                        type="date"
                        value={formData.start_date}
                        onChange={(e) => setFormData({ ...formData, start_date: e.target.value })}
                        className="w-full p-2 border rounded-md"
                      />
                    </div>
                    <div>
                      <label className="block text-sm font-medium text-gray-700">End Date</label>
                      <input
                        type="date"
                        value={formData.end_date}
                        onChange={(e) => setFormData({ ...formData, end_date: e.target.value })}
                        className="w-full p-2 border rounded-md"
                      />
                    </div>
                  </div>
                  <div>
                    <label className="block text-sm font-medium text-gray-700">Description</label>
                    <textarea
                      value={formData.description}
                      onChange={(e) => setFormData({ ...formData, description: e.target.value })}
                      className="w-full p-2 border rounded-md"
                      rows="4"
                    />
                  </div>
                  <div className="flex gap-2">
                    <button
                      type="submit"
                      className="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600"
                    >
                      {editingId ? 'Save Changes' : 'Add Experience'}
                    </button>
                    <button
                      type="button"
                      onClick={() => {
                        setIsEditing(false);
                        setEditingId(null);
                      }}
                      className="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600"
                    >
                      Cancel
                    </button>
                  </div>
                </form>
              </div>
            )}

            <div className="space-y-4">
              {experiences.map((experience) => (
                <div key={experience.id} className="bg-white p-6 rounded-lg shadow-md">
                  <div className="flex justify-between items-start">
                    <div>
                      <h3 className="text-lg font-semibold">{experience.position}</h3>
                      <p className="text-gray-600">{experience.company_name}</p>
                    </div>
                    <div className="flex gap-2">
                      <button
                        onClick={() => handleEdit(experience)}
                        className="px-4 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600"
                      >
                        Edit
                      </button>
                      <button
                        onClick={() => handleDelete(experience.id)}
                        className="px-4 py-1 bg-red-500 text-white rounded-md hover:bg-red-600"
                      >
                        Delete
                      </button>
                    </div>
                  </div>
                </div>
              ))}
            </div>
          </div>
        </div>
      </div>
    </>
  );
};

export default WorkExperienceDashboard;