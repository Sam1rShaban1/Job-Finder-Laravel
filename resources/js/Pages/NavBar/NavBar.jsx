import React from "react";
import "./NavBar.css";
import Logo from "../Home/p-removebg-preview 1.png";
import { usePage } from "@inertiajs/react";

const NavBar = () => {
    const { auth } = usePage().props; // Get authenticated user data

    return (
        <header className="home-header flex items-center justify-between p-4 bg-white shadow-md">
            <div className="logo flex items-center">
                <img src={Logo} alt="JobFinder Logo" style={{ height: "40px" }} />
            </div>
            <div className="nav-links flex items-center space-x-4">
                <a href="/" className="text-sm font-medium text-gray-700">Home</a>

                {auth.user ? (
                    // ✅ Clicking on the user name redirects to /dashboard/personal-information
                    <a href="dashboard/personal-information" className="text-sm font-medium text-blue-600 hover:underline">
                        {auth.user.name}
                    </a>
                ) : (
                    // Show login link for unauthenticated users
                    <a href="/login" className="text-sm font-medium text-gray-700">Login</a>
                )}
            </div>
        </header>
    );
};

export default NavBar;