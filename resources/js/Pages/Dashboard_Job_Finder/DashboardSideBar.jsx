import React from "react";
import { useForm } from "@inertiajs/react";
import { Link } from "@inertiajs/react";

const Sidebar = ({ activePage }) => {
  const menuItems = [
    { name: "Personal Information", path: route('dashboard.personal.information') },
    { name: "Work Experience", path: route('work-experiences.index') },
    { name: "Skills", path: route('dashboard.skills') },
    { name: "Education", path: route('dashboard.education') },
    { name: "Certifications", path: route('dashboard.certifications') },
    { name: "Professional Summary", path: route('dashboard.professional.summary') },
    { name: "Applications", path: route('dashboard.applications') },
  ];
  function safeRoute(name) {
    try {
      return route(name);
    } catch (error) {
      console.error(`Error generating route for ${name}:`, error);
      return '#';
    }
  }
  // Use Inertia's useForm for logout
  const { post } = useForm();

  const handleLogout = () => {
    post(route("logout")); 
  };

  const hasProfessionalSummary = window.ziggy && window.ziggy.routes 
    ? Object.prototype.hasOwnProperty.call(window.ziggy.routes, 'dashboard.professional.summary')
    : false;
  
  let professionalSummaryUrl = '#';
  if (hasProfessionalSummary) {
    try {
      professionalSummaryUrl = route('dashboard.professional.summary', {});
    } catch (error) {
      console.error("Error generating professionalSummaryUrl:", error);
      professionalSummaryUrl = '#';
    }
  }

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
            <Link href={item.path}>{item.name}</Link>
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