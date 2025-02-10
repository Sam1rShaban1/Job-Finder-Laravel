import React, { useState, useEffect } from "react";
import { usePage, useForm } from "@inertiajs/react";
import NavBar from "../../NavBar/NavBar";
import Sidebar from "../DashboardSideBar";

const DashboardCertification = () => {
  const { certifications = [] } = usePage().props;
  const [certificationsList, setCertificationsList] = useState(certifications || []);

  const { post, processing, reset, errors } = useForm();

  const [editCertification, setEditCertification] = useState(null);
  const [isModalOpen, setIsModalOpen] = useState(false);
  const [isAddingNew, setIsAddingNew] = useState(false);

  const [editedCertificate, setEditedCertificate] = useState("");
  const [editedIssuedBy, setEditedIssuedBy] = useState("");
  const [editedStartDate, setEditedStartDate] = useState("");
  const [editedCredentialId, setEditedCredentialId] = useState("");

  useEffect(() => {
    setCertificationsList((prevList) => {
      if (JSON.stringify(prevList) !== JSON.stringify(certifications)) {
        return certifications || [];
      }
      return prevList;
    });
  }, [certifications]);
  

  const handleEdit = (certification) => {
    setEditCertification(certification);
    setEditedCertificate(certification.certificate);
    setEditedIssuedBy(certification.issuedBy);
    setEditedStartDate(certification.startDate || "");
    setEditedCredentialId(certification.credential_id || "");
    setIsAddingNew(false);
    setIsModalOpen(true);
  };

  const handleAdd = () => {
    setEditedCertificate("");
    setEditedIssuedBy("");
    setEditedStartDate("");
    setEditedCredentialId("");
    setIsAddingNew(true);
    setIsModalOpen(true);
  };

  const handleSave = () => {
    if (!editedCertificate.trim() || !editedIssuedBy.trim()) {
      alert("Both Certificate Name and Issued By are required.");
      return;
    }
  
    const url = isAddingNew ? route("certifications.store") : route("certifications.update", editCertification.id);
    const method = isAddingNew ? "post" : "patch";
  
    post(url, {
      method,
      preserveScroll: true,
      data: {
        certificate: editedCertificate,
        issuedBy: editedIssuedBy,
        startDate: editedStartDate,
        credential_id: editedCredentialId,
      },
      onSuccess: () => {
        setIsModalOpen(false);
        reset();
      },
      onError: (newErrors) => {
        console.error(newErrors); // Logs validation errors
      },
    });
  };
  

  const handleDelete = (id) => {
    if (!confirm("Are you sure you want to delete this certification?")) return;

    post(route("certifications.destroy", id), {
      method: "delete",
      preserveScroll: true,
      onSuccess: () => setCertificationsList(certificationsList.filter((cert) => cert.id !== id)),
      onError: (errors) => console.error(errors),
    });
  };

  return (
    <>
      <NavBar userName="JobFinder's Name" />
      <div className="min-h-screen flex bg-gray-100">
        <Sidebar activePage="Certifications" />
        <div className="flex-1 flex flex-col items-center mt-4 -mb-8">
          <main className="bg-white w-full max-w-2xl p-8 rounded-lg shadow-md">
            <h2 className="text-2xl font-bold text-blue-500 text-center mb-6">Certifications</h2>
            <hr className="mb-6" />

            <button
              onClick={handleAdd}
              className="mb-6 py-2 px-4 bg-green-500 text-white font-bold rounded-md hover:bg-green-600 transition duration-200"
            >
              + Add Certification
            </button>

            {errors && <p className="text-red-500">{errors.message}</p>}

            {certificationsList.length > 0 ? (
              <div className="space-y-4">
                {certificationsList.map((certification) => (
                  <div
                    key={certification.id}
                    className="bg-white p-4 rounded-lg shadow-md flex justify-between items-center"
                  >
                    <div>
                      <h3 className="text-lg font-bold text-blue-500">{certification.certificate}</h3>
                      <p className="text-sm text-blue-500">{certification.issuedBy}</p>
                    </div>
                    <div className="flex space-x-2">
                      <button
                        className="py-1 px-3 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-200"
                        onClick={() => handleEdit(certification)}
                      >
                        Edit
                      </button>
                      <button
                        className="py-1 px-3 bg-red-500 text-white rounded-md hover:bg-red-600 transition duration-200"
                        onClick={() => handleDelete(certification.id)}
                      >
                        Delete
                      </button>
                    </div>
                  </div>
                ))}
              </div>
            ) : (
              <p className="text-center text-gray-500">No certifications added yet.</p>
            )}
          </main>
        </div>
      </div>

      {isModalOpen && (
        <div className="fixed inset-0 bg-black bg-opacity-60 flex justify-center items-center">
          <div className="bg-white p-8 rounded-xl shadow-xl w-[500px] relative">
            <button
              onClick={() => setIsModalOpen(false)}
              className="absolute top-3 right-3 text-gray-500 hover:text-gray-800 text-xl"
            >
              ✖
            </button>

            <h3 className="text-2xl font-semibold text-blue-600 mb-6 text-center">
              {isAddingNew ? "Add New Certification" : "Edit Certification"}
            </h3>

            <label className="block text-sm font-medium text-gray-700 mb-2">Certificate Name</label>
            <input type="text" value={editedCertificate} onChange={(e) => setEditedCertificate(e.target.value)} className="w-full p-3 border border-gray-300 rounded-lg text-sm bg-gray-50 focus:ring-2 focus:ring-blue-500 transition duration-200" placeholder="Enter certificate name" />

            <label className="block text-sm font-medium text-gray-700 mt-4 mb-2">Issued By</label>
            <input type="text" value={editedIssuedBy} onChange={(e) => setEditedIssuedBy(e.target.value)} className="w-full p-3 border border-gray-300 rounded-lg text-sm bg-gray-50 focus:ring-2 focus:ring-blue-500 transition duration-200" placeholder="Enter issuing organization" />

            <label className="block text-sm font-medium text-gray-700 mt-4 mb-2">Start Date</label>
            <input type="date" value={editedStartDate} onChange={(e) => setEditedStartDate(e.target.value)} className="w-full p-3 border border-gray-300 rounded-lg text-sm bg-gray-50 focus:ring-2 focus:ring-blue-500 transition duration-200" />

            <label className="block text-sm font-medium text-gray-700 mt-4 mb-2">Credential ID</label>
            <input type="text" value={editedCredentialId} onChange={(e) => setEditedCredentialId(e.target.value)} className="w-full p-3 border border-gray-300 rounded-lg text-sm bg-gray-50 focus:ring-2 focus:ring-blue-500 transition duration-200" placeholder="Enter credential ID" />

            <div className="flex justify-end space-x-3 mt-6">
              <button onClick={() => setIsModalOpen(false)} className="py-2 px-5 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-200">Cancel</button>
              <button onClick={handleSave} disabled={processing} className="py-2 px-5 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-200">{processing ? "Saving..." : "Save"}</button>
            </div>
          </div>
        </div>
      )}
    </>
  );
};

export default DashboardCertification;
