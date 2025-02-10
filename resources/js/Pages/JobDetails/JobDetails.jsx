import React, { useEffect, useState } from "react";
import "./JobDetails.css";
import NavBar from "../NavBar/NavBar";
import { Link, usePage, router } from "@inertiajs/react";

const JobDetails = () => {
    const { job: initialJob } = usePage().props;
    const [job, setJob] = useState(initialJob);

    useEffect(() => {
        setJob(initialJob);
        console.log("Updated Job State:", initialJob);
    }, [initialJob]);

    console.log("Received Job Data:", job);

    // ✅ Function to format salary correctly
    const formatSalary = (salary) => {
        if (!salary) return "Salary Not Provided";

        // ✅ Extract salary correctly from `salary_range`
        const salaryRange = salary?.salary_range || salary;

        if (salaryRange?.min !== undefined && salaryRange?.max !== undefined) {
            return `$${salaryRange.min.toLocaleString()} - $${salaryRange.max.toLocaleString()}`;
        }

        return "Salary Not Provided";
    };

    const handleApply = () => {
        router.post(route("jobs.apply", job.id), {}, {
            onSuccess: () => {
                router.post(route("applications.send.applied.email", job.id), {}, {
                    onSuccess: () => {
                        console.log("Email sent successfully!");
                    },
                    onError: (error) => {
                        console.error("Error sending email:", error);
                    }
                });
    
                router.visit(route("job.details", job.id));
            }
        });
    };

    return (
        <div className="job-details-container">
            <NavBar />
            <main className="job-details-content">
                <div className="job-details-left">
                    <div className="job-header">
                        <div className="job-header-info">
                            <h1 className="job-title">{job?.title || "No Title Available"}</h1>
                            <h3 className="company-name">{job?.employer?.company_name || "Unknown Company"}</h3>
                            <p className="job-location">
                                <i className="bi bi-geo-alt"></i> {job?.location || "Location Not Provided"}
                            </p>
                            <p className="job-type">
                                <i className="bi bi-briefcase-fill"></i> {job?.type || "Job Type Not Provided"}
                            </p>
                            <p className="experience-level">
                                <i className="bi bi-graph-up"></i> {job?.experience_level || "Experience Level Not Provided"}
                            </p>
                            <p className="closing-date">
                                <i className="bi bi-calendar-check"></i> Closing Date: {job?.closing_date ? new Date(job.closing_date).toDateString() : "Not Specified"}
                            </p>
                        </div>
                        <div className="company-logo-small">
                            {job?.employer?.logo ? (
                                <img src={job.employer.logo} alt="Company Logo" />
                            ) : (
                                <i className="bi bi-buildings"></i>
                            )}
                        </div>
                    </div>
                    <hr />

                    <p className="job-description">{job?.description || "No job description provided."}</p>
                    <hr style={{ marginTop: "20px" }} />

                    {/* Salary Display & Apply Button */}
                    <div className="job-salary-apply">
                        <p className="job-salary">
                            <i className="bi bi-cash-stack"></i> {formatSalary(job?.salary_range)}
                        </p>
                        <button className="apply-button" onClick={handleApply}>
                            Apply
                        </button>
                    </div>

                    {/* Job Requirements */}
                    {job?.requirements?.length > 0 && (
                        <div className="job-requirements">
                            <h4>Requirements:</h4>
                            <ul>
                                {job.requirements.map((req, index) => (
                                    <li key={index}><i className="bi bi-check-circle"></i> {req}</li>
                                ))}
                            </ul>
                        </div>
                    )}
                </div>
            </main>
        </div>
    );
};

export default JobDetails;