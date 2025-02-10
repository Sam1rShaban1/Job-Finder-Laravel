import React, { useState } from "react";
import NavBar from "../../NavBar/NavBar";
import { router } from "@inertiajs/react";

const Certification = () => {
  const [certifications, setCertifications] = useState([]);
  const [editingIndex, setEditingIndex] = useState(null);
  const [formData, setFormData] = useState({
    name: '',
    issuedBy: '',
    startDate: '',
    endDate: '',
    credential_id: ''
  });

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value
    });
  };

  const handleAddMore = (e) => {
    e.preventDefault();
    if (!formData.name || !formData.issuedBy) return;

    setCertifications([...certifications, formData]);
    setFormData({
      name: '',
      issuedBy: '',
      startDate: '',
      endDate: '',
      credential_id: ''
    });
  };

  const handleDelete = (index) => {
    const updatedCertifications = certifications.filter((_, i) => i !== index);
    setCertifications(updatedCertifications);
  };

  const handleEdit = (index) => {
    setEditingIndex(index);
    setFormData(certifications[index]);
  };

  const handleSkip = () => {
    router.visit(route('account.success'));
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    
    // If there are saved certifications, submit them all
    if (certifications.length > 0) {
      certifications.forEach(cert => {
        router.post(route('certification.store'), {
          ...cert,
          credential_id: "CERT-" + Date.now()
        });
      });
    }
    
    // If there's data in the form, submit that too
    if (formData.name && formData.issuedBy) {
      router.post(route('certification.store'), {
        ...formData,
        credential_id: "CERT-" + Date.now()
      });
    }

    router.visit(route('account.success'));
  };

  return (
    <div>
      <NavBar />
      <div className="min-h-screen flex items-start justify-center bg-gray-100 p-8">
        <div className={`flex w-full max-w-7xl gap-8 ${certifications.length > 0 ? 'flex-row' : 'flex-col'}`}>
          {/* Form Section */}
          <div className={certifications.length > 0 ? 'w-1/2' : 'w-full max-w-2xl mx-auto'}>
            <main className="bg-white p-8 rounded-lg shadow-md">
              <h2 className="text-2xl font-bold text-blue-500 text-center mb-6">
                Certification
              </h2>
              <form onSubmit={handleSubmit} className="flex flex-col gap-4">
                <div>
                  <label htmlFor="name" className="block text-sm font-medium text-gray-700">
                    Name:
                  </label>
                  <input
                    type="text"
                    id="name"
                    name="name"
                    value={formData.name}
                    onChange={handleChange}
                    className="w-full p-2 border border-gray-300 rounded-md"
                    placeholder="Enter certification name"
                  />
                </div>

                <div>
                  <label htmlFor="issuedBy" className="block text-sm font-medium text-gray-700">
                    Issued by:
                  </label>
                  <input
                    type="text"
                    id="issuedBy"
                    name="issuedBy"
                    value={formData.issuedBy}
                    onChange={handleChange}
                    className="w-full p-2 border border-gray-300 rounded-md"
                    placeholder="Enter issuer"
                  />
                </div>

                <div>
                  <label htmlFor="startDate" className="block text-sm font-medium text-gray-700">
                    Start Date:
                  </label>
                  <input
                    type="date"
                    id="startDate"
                    name="startDate"
                    value={formData.startDate}
                    onChange={handleChange}
                    className="w-full p-2 border border-gray-300 rounded-md"
                  />
                </div>

                <div>
                  <label htmlFor="endDate" className="block text-sm font-medium text-gray-700">
                    End Date:
                  </label>
                  <input
                    type="date"
                    id="endDate"
                    name="endDate"
                    value={formData.endDate}
                    onChange={handleChange}
                    className="w-full p-2 border border-gray-300 rounded-md"
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
                  Skip if no certifications
                </button>
              </form>
            </main>
          </div>

          {/* Saved Certifications Section */}
          {certifications.length > 0 && (
            <div className="w-1/2">
              <div className="space-y-4">
                {certifications.map((cert, index) => (
                  <div key={index} className="bg-white p-6 rounded-lg shadow-md">
                    <h3 className="text-lg font-bold text-gray-800">{cert.name}</h3>
                    <p className="text-gray-600">{cert.issuedBy}</p>
                    <p className="text-sm text-gray-500">
                      {cert.startDate} - {cert.endDate || 'Present'}
                    </p>
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

export default Certification;