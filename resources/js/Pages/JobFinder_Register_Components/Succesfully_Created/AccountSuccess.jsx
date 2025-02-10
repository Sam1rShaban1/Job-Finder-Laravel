import React from "react";
import { Link } from '@inertiajs/react';
import NavBar from "../../NavBar/NavBar";

const AccountSuccess = () => {
  return (
    <>
    <NavBar />
    <div className="min-h-screen flex items-center justify-center bg-gray-100">
      <main className="bg-white w-full max-w-md p-8 rounded-lg shadow-md text-center min-h-[35vh]">
        <h2 className="text-2xl font-bold text-blue-500 mb-4">
          You have successfully created your account
        </h2>
        <hr />
        <p className="text-sm text-gray-600 mb-6">
          You have also successfully applied for the job
        </p>
        <Link 
          href={route('home')} 
          className="py-3 px-6 bg-black text-white font-bold rounded-md hover:bg-gray-800 transition duration-200 inline-block "
        >
          Return to Homepage
        </Link>
      </main>
    </div>
    </>
  );
};

export default AccountSuccess;