import React from "react";
import NavBar from "../../NavBar/NavBar";
import Sidebar from "../DashboardSideBar";
import { usePage } from '@inertiajs/react';

const DashboardApplications = ({ applications }) => {
  const { auth } = usePage().props;

  return (
    <>
      <NavBar userName={auth.user.name} />
      <div className="min-h-screen flex bg-gray-100">
        <Sidebar activePage="Applications"/>
        <div className="flex-1 flex items-start justify-center mt-4 -mb-8">
          <main className="bg-white w-full max-w-2xl p-8 rounded-lg shadow-md">
            <h2 className="text-2xl font-bold text-blue-500 text-center mb-6">
              My Applications
            </h2>
            <hr className="mb-6" />
            <div className="space-y-4">
              {applications.map((application) => (
                <div
                  key={application.id}
                  className="bg-white p-4 rounded-lg shadow-md flex justify-between items-center"
                >
                  <div className="flex items-center space-x-4">
                    <div className="bg-blue-100 p-4 rounded-md flex items-center justify-center">
                      <p className="text-sm text-blue-500">
                        {application.job_listing.employer.company_name.charAt(0)}
                      </p>
                    </div>
                    <div>
                      <h3 className="text-lg font-bold text-blue-500">
                        {application.job_listing.title}
                      </h3>
                      <p className="text-sm text-blue-500">
                        {application.job_listing.employer.company_name}
                      </p>
                      <p className="text-sm text-gray-500">
                        Status: {application.status}
                      </p>
                      <p className="text-xs text-gray-400">
                        Applied: {new Date(application.applied_at).toLocaleDateString()}
                      </p>
                    </div>
                  </div>
                  {application.status !== 'withdrawn' && (
                    <button 
                      onClick={() => handleWithdraw(application.id)}
                      className="py-1 px-3 bg-red-500 text-white rounded-md hover:bg-red-600"
                    >
                      Withdraw
                    </button>
                  )}
                </div>
              ))}
            </div>
          </main>
        </div>
      </div>
    </>
  );
};

export default DashboardApplications;
