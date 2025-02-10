import React, { useState } from "react";
import NavBar from "../../NavBar/NavBar";
import Sidebar from "../DashboardSideBar";

const EducationDashboard = () => {
  const [educationList, setEducationList] = useState([
    { id: 1, degree: "Bachelor of Science", institution: "University A" },
    { id: 2, degree: "Master of Business", institution: "University B" },
    { id: 3, degree: "PhD in Computer Science", institution: "University C" },
  ]);

  const [editEducation, setEditEducation] = useState(null);
  const [isModalOpen, setIsModalOpen] = useState(false);
  const [isAddingNew, setIsAddingNew] = useState(false);

  const [editedDegree, setEditedDegree] = useState("");
  const [editedInstitution, setEditedInstitution] = useState("");

  // Open Edit Modal
  const handleEdit = (education) => {
    setEditEducation(education);
    setEditedDegree(education.degree);
    setEditedInstitution(education.institution);
    setIsAddingNew(false);
    setIsModalOpen(true);
  };

  // Open Add Modal
  const handleAdd = () => {
    setEditedDegree("");
    setEditedInstitution("");
    setIsAddingNew(true);
    setIsModalOpen(true);
  };

  // Save Changes or Add New Education
  const handleSave = () => {
    if (isAddingNew) {
      setEducationList((prevEducationList) =>
        [...prevEducationList, { id: Date.now(), degree: editedDegree, institution: editedInstitution }]
          .sort((a, b) => a.degree.localeCompare(b.degree)) // Sort Alphabetically
      );
    } else {
      setEducationList((prevEducationList) =>
        prevEducationList.map((edu) =>
          edu.id === editEducation.id ? { ...edu, degree: editedDegree, institution: editedInstitution } : edu
        )
      );
    }
    setIsModalOpen(false);
  };

  // Delete Education Entry
  const handleDelete = (id) => {
    setEducationList(educationList.filter((edu) => edu.id !== id));
  };

  return (
    <>
      <NavBar userName="JobFinder's Name" />
      <div className="min-h-screen flex bg-gray-100">
        <Sidebar activePage="Education" />
        <div className="flex-1 flex flex-col items-center mt-4 -mb-8">
          <main className="bg-white w-full max-w-2xl p-8 rounded-lg shadow-md">
            <h2 className="text-2xl font-bold text-blue-500 text-center mb-6">
              Education
            </h2>
            <hr className="mb-6" />

            {/* Add New Education Button */}
            <button
              onClick={handleAdd}
              className="mb-6 py-2 px-4 bg-green-500 text-white font-bold rounded-md hover:bg-green-600 transition duration-200"
            >
              + Add Education
            </button>

            <div className="space-y-4">
              {educationList.map((education) => (
                <div
                  key={education.id}
                  className="bg-white p-4 rounded-lg shadow-md flex justify-between items-center"
                >
                  <div>
                    <h3 className="text-lg font-bold text-blue-500">{education.degree}</h3>
                    <p className="text-sm text-blue-500">{education.institution}</p>
                  </div>
                  <div className="flex space-x-2">
                    <button
                      className="py-1 px-3 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-200"
                      onClick={() => handleEdit(education)}
                    >
                      Edit
                    </button>
                    <button
                      className="py-1 px-3 bg-red-500 text-white rounded-md hover:bg-red-600 transition duration-200"
                      onClick={() => handleDelete(education.id)}
                    >
                      Delete
                    </button>
                  </div>
                </div>
              ))}
            </div> {/* ✅ Fixed Closing div */}
          </main>
        </div>
      </div>

      {/* ✅ Edit/Add Modal */}
      {isModalOpen && (
        <div className="fixed inset-0 bg-black bg-opacity-60 flex justify-center items-center">
          <div className="bg-white p-8 rounded-xl shadow-xl w-[500px] relative">
            
            {/* Close Button */}
            <button
              onClick={() => setIsModalOpen(false)}
              className="absolute top-3 right-3 text-gray-500 hover:text-gray-800 text-xl"
            >
              ✖
            </button>

            <h3 className="text-2xl font-semibold text-blue-600 mb-6 text-center">
              {isAddingNew ? "Add New Education" : "Edit Education"}
            </h3>

            <label className="block text-sm font-medium text-gray-700 mb-2">
              Degree
            </label>
            <input
              type="text"
              value={editedDegree}
              onChange={(e) => setEditedDegree(e.target.value)}
              className="w-full p-3 border border-gray-300 rounded-lg text-sm bg-blue-700 text-white focus:ring-2 focus:ring-blue-500 transition duration-200"
              placeholder="Enter degree"
            />

            <label className="block text-sm font-medium text-gray-700 mt-4 mb-2">
              Institution
            </label>
            <input
              type="text"
              value={editedInstitution}
              onChange={(e) => setEditedInstitution(e.target.value)}
              className="w-full p-3 border border-gray-300 rounded-lg text-sm bg-blue-700 text-white focus:ring-2 focus:ring-blue-500 transition duration-200"
              placeholder="Enter institution"
            />

            <div className="flex justify-end space-x-3 mt-6">
              <button
                onClick={() => setIsModalOpen(false)}
                className="py-2 px-5 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-200"
              >
                Cancel
              </button>
              <button
                onClick={handleSave}
                className="py-2 px-5 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-200"
              >
                Save
              </button>
            </div>
          </div>
        </div>
      )}
    </>
  );
};

export default EducationDashboard;