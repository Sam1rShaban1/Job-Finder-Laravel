import React from 'react';
import { useForm } from '@inertiajs/react';
import DashboardLayout from "../DashboardLayout";
import Sidebar from "../DashboardSideBar";

const CompanyInfoDashboard = ({ company }) => {
  // Initialize form with current company data (or default values)
  const { data, setData, put, processing, errors } = useForm({
    companyname: company?.companyname || '',
    companyoverview: company?.companyoverview || '',
    companyculture: company?.companyculture || '',
    companywebsite: company?.companywebsite || '',
    address: company?.address || '',
    // File input is managed separately; leaving it as null here.
    companylogo: null,
  });

  const handleSubmit = (e) => {
    e.preventDefault();
    put(route('dashboard.company.info.update'), {
      preserveScroll: true,
      preserveState: true,
    });
  };

  return (
    <div className="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6 mt-8">
      <h2 className="text-2xl font-bold text-blue-500 mb-6">Company Information</h2>
      <hr className="mb-6" />
      <form onSubmit={handleSubmit} className="space-y-6">
        <div>
          <label htmlFor="companyname" className="block text-sm font-medium text-gray-700">
            Company Name:
          </label>
          <input 
            type="text" 
            id="companyname" 
            name="companyname" 
            value={data.companyname}
            onChange={e => setData('companyname', e.target.value)}
            className="w-full p-2 border border-gray-300 rounded-md" 
            required 
          />
          {errors.companyname && <p className="text-red-500 text-sm">{errors.companyname}</p>}
        </div>

        <div>
          <label htmlFor="companyoverview" className="block text-sm font-medium text-gray-700">
            Company Overview:
          </label>
          <textarea 
            id="companyoverview" 
            name="companyoverview" 
            value={data.companyoverview}
            onChange={e => setData('companyoverview', e.target.value)}
            className="w-full p-2 border border-gray-300 rounded-md" 
            required 
          />
          {errors.companyoverview && <p className="text-red-500 text-sm">{errors.companyoverview}</p>}
        </div>

        <div>
          <label htmlFor="companyculture" className="block text-sm font-medium text-gray-700">
            Company Culture:
          </label>
          <textarea 
            id="companyculture" 
            name="companyculture" 
            value={data.companyculture}
            onChange={e => setData('companyculture', e.target.value)}
            className="w-full p-2 border border-gray-300 rounded-md" 
            required 
          />
          {errors.companyculture && <p className="text-red-500 text-sm">{errors.companyculture}</p>}
        </div>

        <div>
          <label htmlFor="companywebsite" className="block text-sm font-medium text-gray-700">
            Company Website:
          </label>
          <input 
            type="url" 
            id="companywebsite" 
            name="companywebsite" 
            value={data.companywebsite}
            onChange={e => setData('companywebsite', e.target.value)}
            className="w-full p-2 border border-gray-300 rounded-md" 
            required 
          />
          {errors.companywebsite && <p className="text-red-500 text-sm">{errors.companywebsite}</p>}
        </div>

        <div>
          <label htmlFor="address" className="block text-sm font-medium text-gray-700">
            Address:
          </label>
          <input 
            type="text" 
            id="address" 
            name="address" 
            value={data.address}
            onChange={e => setData('address', e.target.value)}
            className="w-full p-2 border border-gray-300 rounded-md" 
            required 
          />
          {errors.address && <p className="text-red-500 text-sm">{errors.address}</p>}
        </div>

        <div>
          <label htmlFor="companylogo" className="block text-sm font-medium text-gray-700">
            Company Logo:
          </label>
          <input 
            type="file" 
            id="companylogo" 
            name="companylogo" 
            onChange={e => setData('companylogo', e.target.files[0])}
            className="w-full p-2 border border-gray-300 rounded-md" 
          />
          {errors.companylogo && <p className="text-red-500 text-sm">{errors.companylogo}</p>}
        </div>

        <div className="flex justify-end">
          <button 
            type="submit" 
            disabled={processing}
            className="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-200"
          >
            Save Changes
          </button>
        </div>
      </form>
    </div>
  );
};

CompanyInfoDashboard.layout = (page) => (
  <DashboardLayout>
    <div className="min-h-screen flex bg-gray-100">
      <Sidebar activePage="Company Info" />
      <div className="flex-1 p-8">
        {page}
      </div>
    </div>
  </DashboardLayout>
);

export default CompanyInfoDashboard; 