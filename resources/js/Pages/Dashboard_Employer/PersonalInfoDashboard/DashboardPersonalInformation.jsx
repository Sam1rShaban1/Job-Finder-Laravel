import React from "react";
import { useForm } from '@inertiajs/react';
import DashboardLayout from "../DashboardLayout";
import Sidebar from "../DashboardSideBar";

const DashboardPersonalInformation = ({ user }) => {
    console.log('User data:', user);
    const { data, setData, put, processing, errors } = useForm({
        fullName: user?.name || '',
        email: user?.email || '',
        address: user?.address || '',
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        put(route('dashboard.personal.information.update', {}));
    };

    return (
        <div className="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6 mt-8">
            <h2 className="text-2xl font-bold text-blue-500 mb-6">
                Personal Information
            </h2>
            <hr className="mb-6" />
            <form onSubmit={handleSubmit} className="space-y-6">
                <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1">
                        Full Name
                    </label>
                    <input
                        type="text"
                        value={data.fullName}
                        onChange={e => setData('fullName', e.target.value)}
                        className="w-full p-2 border border-gray-300 rounded-md"
                    />
                    {errors.fullName && (
                        <p className="text-red-500 text-sm mt-1">{errors.fullName}</p>
                    )}
                </div>

                <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1">
                        Email
                    </label>
                    <input
                        type="email"
                        value={data.email}
                        onChange={e => setData('email', e.target.value)}
                        className="w-full p-2 border border-gray-300 rounded-md"
                    />
                    {errors.email && (
                        <p className="text-red-500 text-sm mt-1">{errors.email}</p>
                    )}
                </div>

                <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1">
                        Address
                    </label>
                    <input
                        type="text"
                        value={data.address}
                        onChange={e => setData('address', e.target.value)}
                        className="w-full p-2 border border-gray-300 rounded-md"
                    />
                    {errors.address && (
                        <p className="text-red-500 text-sm mt-1">{errors.address}</p>
                    )}
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

DashboardPersonalInformation.layout = (page) => (
    <DashboardLayout>
        <div className="min-h-screen flex bg-gray-100">
            <Sidebar activePage="Personal Information" />
            <div className="flex-1 p-8">
                {page}
            </div>
        </div>
    </DashboardLayout>
);

export default DashboardPersonalInformation;
