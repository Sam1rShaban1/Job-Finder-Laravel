import React from "react";
import { useForm } from "@inertiajs/react";

const Sidebar = ({ activePage }) => {
  const menuItems = [
    { name: "Personal Information", path: "/dashboard/personal-information" },
    { name: "Company Information", path: "/dashboard/company-information" },
    { name: "Job Postings", path: "/dashboard/job-postings" },
    { name: "Applications", path: "/dashboard/applications" },

  ];

  // Use Inertia's useForm for logout
  const { post } = useForm();

  const handleLogout = () => {
    post(route("logout")); 
  };

  return (
    <div className="w-1/4 bg-white p-4 shadow-md mt-8">
      <ul className="space-y-4">
        {menuItems.map((item) => (
          <li
            key={item.name}
            className={`font-bold p-2 rounded-md ${
              activePage === item.name ? "bg-gray-200" : ""
            }`}
          >
            <a href={item.path}>{item.name}</a>
          </li>
        ))}
      </ul>
      <button
        onClick={handleLogout}
        className="mt-8 w-full py-2 bg-black text-white font-bold rounded-md hover:bg-gray-800 transition duration-200"
      >
        Logout
      </button>
    </div>
  );
};

export default Sidebar;