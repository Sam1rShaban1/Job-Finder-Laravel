import React from 'react';
import NavBar from "../NavBar/NavBar";
import { Head, Link, useForm } from '@inertiajs/react';

export default function Register() {
    const { data, setData, post, processing, errors } = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        role: 'user', // Default role
        profile_picture: null // New field for image upload
    });

    const handleFileChange = (e) => {
        setData('profile_picture', e.target.files[0]);
    };

    const submit = (e) => {
        e.preventDefault();
    
        // Use FormData for file uploads
        const formData = new FormData();
        formData.append("name", data.name);
        formData.append("email", data.email);
        formData.append("password", data.password);
        formData.append("password_confirmation", data.password_confirmation);
        formData.append("role", data.role);
        if (data.profile_picture) {
            formData.append("profile_picture", data.profile_picture);
        }
    
        post(route('register'), {
            data: formData,
            headers: {
                "Content-Type": "multipart/form-data", // Required for file uploads
            },
            onSuccess: (response) => {
                if (response.props.redirect) {
                    window.location.href = response.props.redirect;
                } else {
                    // Redirect based on role
                    window.location.href = data.role === "employer" 
                        ? "/dashboard/personal-information" 
                        : "/dashboard/personal-information";
                }
            },
            onFinish: () => {
                reset('password', 'password_confirmation');
            },
        });
    };

    return (
        <>
            <Head title="Register" />
            <NavBar />
            <div className="min-h-screen flex bg-gray-100">
                <div className="flex-1 flex items-start justify-center mt-4 -mb-8">
                    <main className="bg-white w-full max-w-2xl p-8 rounded-lg shadow-md">
                        <h2 className="text-2xl font-bold text-blue-500 text-center mb-6">
                            Personal Information
                        </h2>
                        <hr className="mb-6" />
                        <form onSubmit={submit} className="space-y-4">
                            
                            {/* Full Name */}
                            <div>
                                <label htmlFor="name" className="block text-sm font-medium text-gray-700">
                                    Full Name:
                                </label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value={data.name}
                                    onChange={(e) => setData('name', e.target.value)}
                                    className="w-full p-2 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    required
                                />
                                {errors.name && <div className="text-red-500 text-sm mt-1">{errors.name}</div>}
                            </div>

                            {/* Email */}
                            <div>
                                <label htmlFor="email" className="block text-sm font-medium text-gray-700">
                                    Email:
                                </label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value={data.email}
                                    onChange={(e) => setData('email', e.target.value)}
                                    className="w-full p-2 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    required
                                />
                                {errors.email && <div className="text-red-500 text-sm mt-1">{errors.email}</div>}
                            </div>

                            {/* Password */}
                            <div>
                                <label htmlFor="password" className="block text-sm font-medium text-gray-700">
                                    Password:
                                </label>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    value={data.password}
                                    onChange={(e) => setData('password', e.target.value)}
                                    className="w-full p-2 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    required
                                />
                                {errors.password && <div className="text-red-500 text-sm mt-1">{errors.password}</div>}
                            </div>

                            {/* Confirm Password */}
                            <div>
                                <label htmlFor="password_confirmation" className="block text-sm font-medium text-gray-700">
                                    Confirm Password:
                                </label>
                                <input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    value={data.password_confirmation}
                                    onChange={(e) => setData('password_confirmation', e.target.value)}
                                    className="w-full p-2 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    required
                                />
                            </div>

                            {/* Role Selection */}
                            <div>
                                <label htmlFor="role" className="block text-sm font-medium text-gray-700">
                                    Register As:
                                </label>
                                <select
                                    id="role"
                                    name="role"
                                    value={data.role}
                                    onChange={(e) => setData('role', e.target.value)}
                                    className="w-full p-2 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    required
                                >
                                    <option value="user">Job Finder</option>
                                    <option value="employer">Employer</option>
                                </select>
                            </div>

                            {/* Profile Picture Upload */}
                            <div>
                                <label htmlFor="profile_picture" className="block text-sm font-medium text-gray-700">
                                    Upload Profile Picture:
                                </label>
                                <input
                                    type="file"
                                    id="profile_picture"
                                    name="profile_picture"
                                    accept="image/*"
                                    onChange={handleFileChange}
                                    className="w-full p-2 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                />
                            </div>

                            {/* Submit Button */}
                            <div className="flex items-center justify-between mt-4">
                                <Link
                                    href={route('login')}
                                    className="text-sm text-blue-500 hover:text-blue-700"
                                >
                                    Already registered?
                                </Link>
                                <button
                                    type="submit"
                                    disabled={processing}
                                    className="py-2 px-4 bg-black text-white font-bold rounded-md hover:bg-gray-800 transition duration-200"
                                >
                                    Register
                                </button>
                            </div>
                        </form>
                    </main>
                </div>
            </div>
        </>
    );
}