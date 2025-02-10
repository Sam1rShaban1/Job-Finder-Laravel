import React from "react";
import { Link, usePage } from '@inertiajs/react';
import Footer from "../Footer/Footer";
import NavBar from "../NavBar/NavBar";
import "./HomeStyle.css";

const Home = () => {
  // Destructure jobs from Inertia page props
  const { jobs = [] } = usePage().props;

  console.log(jobs); // Debugging: Check if jobs data is being received

  return (
    <div className="home-container">
      <NavBar />
      <main>
        <div className="search-section">
          <h1 className="job-title">Find your dream job</h1>
          <div className="search-bar">
            <input type="text" placeholder="Job Search" className="job-input" />
            <button className="search-button">
              <i className="bi bi-search"></i>
            </button>
          </div>
        </div>

        <div className="jobs-section">
          {jobs.length > 0 ? (
            jobs.map((job) => (
              <div className="job-card" key={job.id}>
                <div className="job-logo">Company Logo</div>
                <div className="job-info">
                  <h3>{job.title}</h3>
                  <p>{job.employer.name}</p>
                  <p><i className="bi bi-geo-alt"></i> {job.location}</p>
                </div>
                <Link href={route('job.details', { id: job.id })} className="apply-button">
                  Apply
                </Link>
              </div>
            ))
          ) : (
            <p>No job listings available at the moment.</p>
          )}
        </div>

        <button className="load-more-button">Load More</button>
      </main>
      <Footer />
    </div>
  );
};

export default Home;
