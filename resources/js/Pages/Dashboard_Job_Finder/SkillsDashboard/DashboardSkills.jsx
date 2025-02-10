import React, { useState } from "react";
import { usePage, useForm } from "@inertiajs/react"; // Import Inertia Hooks
import NavBar from "../../NavBar/NavBar";
import Sidebar from "../DashboardSideBar";

const DashboardSkills = () => {
  // Get skills from props with a default empty array
  const { userSkills = [] } = usePage().props;
  const [skills, setSkills] = useState(userSkills); // Initialize directly without useEffect

  // Inertia Form for skill creation/editing
  const { data, setData, post, put, delete: destroySkill, processing, errors, reset } = useForm({
    name: "",
    proficiency: "",
  });

  // Inline Editing States (instead of modal states)
  const [isEditing, setIsEditing] = useState(false);
  const [editingId, setEditingId] = useState(null);

  // Open inline editing for an existing skill
  const handleEdit = (skill) => {
    setData({
      name: skill.name,
      proficiency: skill.proficiency,
    });
    setEditingId(skill.id);
    setIsEditing(true);
  };

  // Open inline form for adding a new skill
  const handleAdd = () => {
    reset();
    setEditingId(null);
    setIsEditing(true);
  };

  // Save changes for new or edited skill
  const handleSave = (e) => {
    e.preventDefault();

    if (editingId === null) {
      post(route('skills.store'), {
        preserveScroll: true,
        onSuccess: (response) => {
          console.log("Skill store response:", response);
          setIsEditing(false);
          reset();
          // Check if response contains a "skill" key
          if (response && response.skill) {
            setSkills([...skills, response.skill]);
          } else {
            // Fallback: create a temporary skill object using the current form values
            const tempSkill = { id: Date.now(), name: data.name, proficiency: data.proficiency };
            setSkills([...skills, tempSkill]);
          }
        },
      });
    } else {
      put(route('skills.update', editingId), {
        preserveScroll: true,
        onSuccess: (response) => {
          console.log("Skill update response:", response);
          setIsEditing(false);
          reset();
          if (response && response.skill) {
            // Update the edited skill with the response data
            setSkills(skills.map(skill =>
              skill.id === editingId ? response.skill : skill
            ));
          } else {
            console.warn("No 'skill' key returned in update response; using current form data as fallback.");
            // Fallback update: update the skill using the current form values
            setSkills(skills.map(skill =>
              skill.id === editingId ? { ...skill, name: data.name, proficiency: data.proficiency } : skill
            ));
          }
        },
      });
    }
  };

  // ✅ Delete Skill
  const handleDelete = (skillId) => {
    if (confirm("Are you sure you want to delete this skill?")) {
      destroySkill(route('skills.destroy', skillId), {
        onSuccess: (response) => {
          console.log("Skill delete response:", response);
          setSkills(skills.filter(skill => skill.id !== skillId));
        },
      });
    }
  };

  return (
    <>
      <NavBar userName="JobFinder's Name" />
      <div className="min-h-screen flex bg-gray-100">
        <Sidebar activePage="Skills" />
        <div className="flex-1 p-8">
          <div className="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6">
            <h1 className="text-2xl font-bold text-center text-blue-600 mb-6">Skills</h1>
            
            <button
              onClick={handleAdd}
              className="mb-6 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition"
            >
              + Add Skill
            </button>

            {isEditing && (
              <div className="bg-white p-6 rounded-lg shadow-md mb-6">
                <form onSubmit={handleSave} className="space-y-4">
                  <div>
                    <label className="block text-sm font-medium text-gray-700 mb-2">
                      Skill Name
                    </label>
                    <input
                      type="text"
                      value={data.name}
                      onChange={e => setData('name', e.target.value)}
                      className="w-full p-3 border border-gray-300 rounded-lg text-sm text-gray-900 focus:ring-2 focus:ring-blue-500 transition"
                      placeholder="Enter skill name"
                      required
                    />
                    {errors.name && <p className="text-red-500 text-sm mt-1">{errors.name}</p>}
                  </div>

                  <div className="mt-4">
                    <label className="block text-sm font-medium text-gray-700 mb-2">
                      Proficiency Level
                    </label>
                    <select
                      value={data.proficiency}
                      onChange={e => setData('proficiency', e.target.value)}
                      className="w-full p-3 border border-gray-300 rounded-lg text-sm text-gray-900 focus:ring-2 focus:ring-blue-500 transition"
                      required
                    >
                      <option value="">Select Level</option>
                      <option value="Junior">Junior</option>
                      <option value="Intermediate">Intermediate</option>
                      <option value="Senior">Senior</option>
                    </select>
                    {errors.proficiency && <p className="text-red-500 text-sm mt-1">{errors.proficiency}</p>}
                  </div>

                  <div className="flex gap-2">
                    <button
                      type="submit"
                      disabled={processing}
                      className="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition"
                    >
                      {editingId ? 'Save Changes' : 'Add Skill'}
                    </button>
                    <button
                      type="button"
                      onClick={() => { setIsEditing(false); setEditingId(null); reset(); }}
                      className="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition"
                    >
                      Cancel
                    </button>
                  </div>
                </form>
              </div>
            )}

            <div className="space-y-4">
              {skills.map((skill) => (
                <div
                  key={skill.id}
                  className="bg-white p-6 rounded-lg shadow-md flex justify-between items-start"
                >
                  <div>
                    <h3 className="text-lg font-semibold">{skill.name}</h3>
                    <p className="text-gray-600">{skill.proficiency}</p>
                  </div>
                  <div className="flex gap-2">
                    <button
                      onClick={() => handleEdit(skill)}
                      className="px-4 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition"
                    >
                      Edit
                    </button>
                    <button
                      onClick={() => handleDelete(skill.id)}
                      className="px-4 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 transition"
                    >
                      Delete
                    </button>
                  </div>
                </div>
              ))}

              {skills.length === 0 && (
                <p className="text-center text-gray-500">No skills added yet.</p>
              )}
            </div>

            {skills.length > 3 && (
              <div className="text-center mt-4">
                <button className="px-6 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-900 transition">
                  View More
                </button>
              </div>
            )}
          </div>
        </div>
      </div>
    </>
  );
};

export default DashboardSkills;