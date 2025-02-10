<?php

use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Employer;
use App\Models\JobListing;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Application;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CompanyReviewController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\PersonalInformationController;
use App\Http\Controllers\ProfessionalSummaryController;
use App\Http\Controllers\WorkExperienceController;
use App\Http\Controllers\SavedJobController;
use App\Http\Controllers\JobListingController;
use App\Http\Controllers\EventLogController;
use App\Http\Controllers\JobCategoryController;
use App\Http\Controllers\JobPerformanceController;
use App\Http\Controllers\JobTypeController;
use App\Http\Controllers\JobSearchController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PreferenceController;
use App\Mail\JobApplicationNotification;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\JobDetailsController;
use App\Http\Controllers\JobListingCategoryController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SavedSearchController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\UserActivityLogController;
use App\Http\Controllers\UserEngagementController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CompanyInfoController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\AccountSuccessController;
use App\Http\Controllers\MailApplicationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\EmailVerificationController;


Route::get('/', [JobListingController::class, 'index'])
->name('home');


Route::get('/register-client', [PersonalInformationController::class, 'show'])->name('register.client');
Route::post('/personal-information', [PersonalInformationController::class, 'store'])->name('personal.information.store');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/personal-information', [PersonalInformationController::class, 'show'])
        ->name('personal.information');
    
    Route::get('/professional-summary', [ProfessionalSummaryController::class, 'show'])
        ->name('professional.summary');
    
    Route::get('/work-experiences', [WorkExperienceController::class, 'index'])
        ->name('work-experiences.index');
    Route::get('/work-experiences/create', [WorkExperienceController::class, 'create'])
        ->name('work-experiences.create');
    Route::post('/work-experiences', [WorkExperienceController::class, 'store'])
        ->name('work-experiences.store');
    Route::put('/work-experiences/{experience}', [WorkExperienceController::class, 'update'])
        ->name('work-experiences.update');
    Route::delete('/work-experiences/{experience}', [WorkExperienceController::class, 'destroy'])
        ->name('work-experiences.destroy');

        Route::get('/performance-metrics', [JobPerformanceController::class, 'index'])
        ->name('performance.metrics');
        
    Route::post('/performance-metrics', [JobPerformanceController::class, 'store']);
    
    Route::put('/performance-metrics/{metric}', [JobPerformanceController::class, 'update'])
        ->name('performance.metrics.update');
        
    Route::delete('/performance-metrics/{metric}', [JobPerformanceController::class, 'destroy'])
        ->name('performance.metrics.destroy');

        Route::get('/admin/job-types', [JobTypeController::class, 'index'])
        ->name('admin.job-types');
        
    Route::post('/admin/job-types', [JobTypeController::class, 'store']);
    
    Route::put('/admin/job-types/{type}', [JobTypeController::class, 'update'])
        ->name('job-types.update');
        
    Route::delete('/admin/job-types/{type}', [JobTypeController::class, 'destroy'])
        ->name('job-types.destroy');

        Route::get('/messages', [MessageController::class, 'index'])
        ->name('messages.index');
        
    Route::post('/messages', [MessageController::class, 'store'])
        ->name('messages.store');
    
    Route::put('/messages/{message}', [MessageController::class, 'update'])
        ->name('messages.update');
        
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])
        ->name('messages.destroy');

    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');
    
    Route::post('/notifications/{notification}/mark-read', [NotificationController::class, 'markAsRead'])
        ->name('notifications.mark-read');
    
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])
        ->name('notifications.mark-all-read');
   
    Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])
        ->name('notifications.destroy');

    Route::get('/personal-information', [PersonalInformationController::class, 'show'])
    ->name('personal.information.show');

    Route::put('/personal-information', [PersonalInformationController::class, 'update'])
    ->name('personal.information.update');

    Route::delete('/personal-information', [PersonalInformationController::class, 'destroy'])
    ->name('personal.information.destroy');

    Route::get('/preferences', [PreferenceController::class, 'show'])
        ->name('preferences.show');
    Route::post('/preferences', [PreferenceController::class, 'store'])
        ->name('preferences.store');
    Route::put('/preferences', [PreferenceController::class, 'update'])
        ->name('preferences.update');

    Route::apiResource('jobs', JobListingController::class);
  
    Route::apiResource('applications', ApplicationController::class);

    // Education routes
    Route::get('/dashboard/education', [EducationController::class, 'index'])
        ->name('dashboard.education');
    Route::get('/education/create', [EducationController::class, 'create'])
        ->name('education.create');
    Route::post('/education', [EducationController::class, 'store'])
        ->name('education.store');
    Route::get('/education/{education}/edit', [EducationController::class, 'edit'])
        ->name('education.edit');
    Route::put('/education/{education}', [EducationController::class, 'update'])
        ->name('education.update');
    Route::delete('/education/{education}', [EducationController::class, 'destroy'])
        ->name('education.destroy');

    Route::get('/jobs/{job}', [JobDetailsController::class, 'show'])
        ->name('jobs.show');
    Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])
        ->name('jobs.apply');

    Route::get('/professional-summary', [ProfessionalSummaryController::class, 'show'])
        ->name('professional.summary.show');
    Route::post('/professional-summary', [ProfessionalSummaryController::class, 'store'])
        ->name('professional.summary.store');
    Route::put('/professional-summary', [ProfessionalSummaryController::class, 'update'])
        ->name('professional.summary.update');
    Route::delete('/professional-summary', [ProfessionalSummaryController::class, 'destroy'])
        ->name('professional.summary.destroy');

    Route::get('/profile', [ProfileController::class, 'show'])
        ->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    Route::get('/reviews', [ReviewController::class, 'index'])
        ->name('reviews.index');
    Route::get('/reviews/{review}', [ReviewController::class, 'show'])
        ->name('reviews.show');
    Route::post('/reviews', [ReviewController::class, 'store'])
        ->name('reviews.store');
    Route::put('/reviews/{review}', [ReviewController::class, 'update'])
        ->name('reviews.update');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])
        ->name('reviews.destroy');

    Route::get('/saved-jobs', [SavedJobController::class, 'index'])
        ->name('saved-jobs.index');
    Route::post('/saved-jobs', [SavedJobController::class, 'store'])
        ->name('saved-jobs.store');
    Route::put('/saved-jobs/{savedJob}', [SavedJobController::class, 'update'])
        ->name('saved-jobs.update');
    Route::delete('/saved-jobs/{savedJob}', [SavedJobController::class, 'destroy'])
        ->name('saved-jobs.destroy');

    Route::get('/saved-searches', [SavedSearchController::class, 'index'])
        ->name('saved-searches.index');
    Route::post('/saved-searches', [SavedSearchController::class, 'store'])
        ->name('saved-searches.store');
    Route::put('/saved-searches/{search}', [SavedSearchController::class, 'update'])
        ->name('saved-searches.update');
    Route::delete('/saved-searches/{search}', [SavedSearchController::class, 'destroy'])
        ->name('saved-searches.destroy');

    Route::get('/skill', [SkillController::class, 'index'])
        ->name('skill.index');
    Route::get('/skill/create', [SkillController::class, 'create'])
        ->name('skill.create');
    Route::post('/skill', [SkillController::class, 'store'])
        ->name('skill.store');
    Route::put('/skill/{skill}', [SkillController::class, 'update'])
        ->name('skill.update');
    Route::delete('/skill/{skill}', [SkillController::class, 'destroy'])
        ->name('skill.destroy');

    Route::get('/activity-logs', [UserActivityLogController::class, 'index'])
        ->name('activity-logs.index');
    Route::post('/activity-logs', [UserActivityLogController::class, 'store'])
        ->name('activity-logs.store');
    Route::put('/activity-logs/{log}', [UserActivityLogController::class, 'update'])
        ->name('activity-logs.update');
    Route::delete('/activity-logs/{log}', [UserActivityLogController::class, 'destroy'])
        ->name('activity-logs.destroy');

    Route::get('/engagements', [UserEngagementController::class, 'index'])
        ->name('engagements.index');
    Route::post('/engagements', [UserEngagementController::class, 'store'])
        ->name('engagements.store');
    Route::put('/engagements/{engagement}', [UserEngagementController::class, 'update'])
        ->name('engagements.update');
    Route::delete('/engagements/{engagement}', [UserEngagementController::class, 'destroy'])
        ->name('engagements.destroy');

    // skill routes
    Route::get('/dashboard/skill', [SkillController::class, 'index'])->name('dashboard.skills');
    Route::post('/skills', [SkillController::class, 'store'])->name('skills.store');
    Route::put('/skill/{skill}', [SkillController::class, 'update'])->name('skill.update');
    Route::delete('/skill/{skill}', [SkillController::class, 'destroy'])->name('skill.destroy');

    Route::get('/dashboard/personal-information', [PersonalInformationController::class, 'show'])->name('dashboard.personal.information');});

    Route::get('/dashboard/personal-information', function () {
        return Inertia::render('Dashboard_Job_Finder\PersonalInfoDashboard\DashboardPersonalInformation');
    })->name('dasboard.personal.information');

Route::get('/professional-summary', function () {
    return Inertia::render('JobFinder_Register_Components/Professional_Summary/Professional_Summary');
})->name('professional.summary');
Route::get('/dashboard/professional-summary', [ProfessionalSummaryController::class, 'show'])
->name('dashboard.professional.summary');

Route::get('/work-experience', function () {
    return Inertia::render('JobFinder_Register_Components/Work_Experience/WorkExperience');
})->name('work.experience');

Route::get('/skill', function () {
    return Inertia::render('JobFinder_Register_Components/Skills_Component/Skills');
})->name('skill');

Route::get('/education', function () {
    return Inertia::render('JobFinder_Register_Components/Education_Component/Education');
})->name('education');

Route::get('/certification', function () {
    return Inertia::render('JobFinder_Register_Components/Certification_Component/Certification');
})->name('certification');

Route::get('/account-success', [AccountSuccessController::class, 'show'])
    ->name('account.success');

Route::get('/kotekot', function () {
    return Inertia::render('JobFinder_Register_Components/Certification_Component/kotekot');
})->name('kotekot');


Route::get('/random-text', function () {
    return Inertia::render('RandomText');
})->middleware(['auth', 'verified'])->name('random-text');

Route::get('/job/{id}', function ($id) {
    // Fetch the job from the database
    $job = JobListing::find($id);

    // Check if the job exists
    if (!$job) {
        return redirect()->route('home')->with('error', 'Job not found.');
    }

    // Pass the job data to the Inertia view
    return Inertia::render('JobDetails/JobDetails', [
        'job' => $job->load(['employer', 'categories']), // Load related data if necessary
        'relatedJobs' => JobListing::where('employer_id', $job->employer_id)
            ->where('id', '!=', $job->id)
            ->with('employer')
            ->limit(4)
            ->get()
    ]);
})->name('job.details');



Route::get('/dashboard/work-experience', function () {
    return Inertia::render('Dashboard_Job_Finder/WorkExperienceDashboard/DashboardWorkExperience');
})->name('dashboard.work.experience');

Route::get('/dashboard/skill', function () {
    return Inertia::render('Dashboard_Job_Finder/SkillsDashboard/DashboardSkills');
})->name('dashboard.skills');

Route::get('/dashboard/certifications', function () {
    return Inertia::render('Dashboard_Job_Finder/CertificationDashboard/DashboardCertification');
})->name('dashboard.certifications');

Route::get('/dashboard/applications', [ApplicationController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard.applications');

Route::post('/register', [RegisterController::class, 'store'])->name('register');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::get('/register', function () {
    return Inertia::render('Auth/PersonalInformation');
})->middleware('guest')->name('register.page');

Route::post('/certifications', [CertificationController::class, 'store'])->name('certifications.store');


Route::post('/personal-information', [PersonalInformationController::class, 'store'])
    ->name('personal.information.store');

Route::post('/professional-summary', [ProfessionalSummaryController::class, 'store'])
    ->name('professional.summary.store');

Route::post('/work-experience', [WorkExperienceController::class, 'store'])
    ->name('work.experience.store');

    Route::middleware(['auth', 'verified'])->group(function () {
        // Application deletion
        Route::delete('/applications/{application}', [ApplicationController::class, 'destroy'])
            ->name('applications.destroy');
        
        // Review deletion
        Route::delete('/reviews/{review}', [CompanyReviewController::class, 'destroy'])
            ->name('reviews.destroy');
        
        // Interview cancellation
        Route::delete('/interviews/{interview}', [InterviewController::class, 'destroy'])
            ->name('interviews.destroy');
    });
    
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_middleware')
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::post('/employers/{employer}/reviews', [CompanyReviewController::class, 'store'])
    ->middleware('auth')
    ->name('employers.reviews.store');

Route::post('/applications/{application}/schedule-interview', [InterviewController::class, 'schedule'])
    ->middleware('auth')
    ->name('applications.schedule.interview');

    Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])
    ->middleware('auth')
    ->name('jobs.apply');

Route::middleware(['auth', 'verified'])->group(function () {
    // Job interactions
    Route::post('/jobs/{job}/save', [SavedJobController::class, 'store'])
        ->name('jobs.save');
    
    // Application management
    Route::delete('/applications/{application}', [ApplicationController::class, 'destroy'])
        ->name('applications.destroy');
    
    // Interview management
    Route::get('/interviews', [InterviewController::class, 'index'])
        ->name('interviews.index');
});

Route::middleware(['auth', 'employer'])->group(function () {
    Route::resource('employers/jobs', JobListingController::class)
        ->names([
            'create' => 'employers.jobs.create',
            'store' => 'employers.jobs.store'
        ]);
    Route::get('/jobs/{jobListing}/categories', [JobListingCategoryController::class, 'index'])
        ->name('job-listings.categories.index');
    
    Route::post('/jobs/{jobListing}/categories', [JobListingCategoryController::class, 'store'])
        ->name('job-listings.categories.store');
    
    Route::delete('/jobs/{jobListing}/categories/{category}', [JobListingCategoryController::class, 'destroy'])
        ->name('job-listings.categories.destroy');

});

Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::get('/admin/event-logs', [EventLogController::class, 'index'])
        ->name('event-logs.index');
    Route::post('/admin/event-logs', [EventLogController::class, 'store'])
        ->name('event-logs.store');
    Route::put('/admin/event-logs/{eventLog}', [EventLogController::class, 'update'])
        ->name('event-logs.update');
    Route::delete('/admin/event-logs/{eventLog}', [EventLogController::class, 'destroy'])
        ->name('event-logs.destroy');
});

Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::get('/admin/job-categories', [JobCategoryController::class, 'index'])
        ->name('job-categories.index');
    Route::post('/admin/job-categories', [JobCategoryController::class, 'store'])
        ->name('job-categories.store');
    Route::put('/admin/job-categories/{category}', [JobCategoryController::class, 'update'])
        ->name('job-categories.update');
    Route::delete('/admin/job-categories/{category}', [JobCategoryController::class, 'destroy'])
        ->name('job-categories.destroy');
});

Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::get('/admin/job-types', [JobTypeController::class, 'index'])
        ->name('job-types.index');
    Route::post('/admin/job-types', [JobTypeController::class, 'store'])
        ->name('job-types.store');
    Route::put('/admin/job-types/{type}', [JobTypeController::class, 'update'])
        ->name('job-types.update');
    Route::delete('/admin/job-types/{type}', [JobTypeController::class, 'destroy'])
        ->name('job-types.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/company-info', [CompanyInfoController::class, 'index'])->name('company.info');
    Route::post('/company-info', [CompanyInfoController::class, 'store'])->name('company.info.store');
});

Route::middleware(['auth'])->group(function () {
    // Company Info routes
    Route::get('/dashboard/company-info', [CompanyInfoController::class, 'index'])->name('dashboard.company.info');
    Route::post('/dashboard/company-info', [CompanyInfoController::class, 'store'])->name('dashboard.company.info.store');
    Route::put('/dashboard/company-info/{employer}', [CompanyInfoController::class, 'update'])->name('dashboard.company.info.update');
    Route::delete('/dashboard/company-info/{employer}', [CompanyInfoController::class, 'destroy'])->name('dashboard.company.info.destroy');
});

Route::middleware(['auth'])->group(function () {
    // Work Experience Dashboard Routes - Put these BEFORE the registration routes
    Route::get('/dashboard/work-experiences', [WorkExperienceController::class, 'index'])
        ->name('work-experiences.index');
    Route::post('/dashboard/work-experiences', [WorkExperienceController::class, 'store'])
        ->name('work-experiences.store');
    Route::put('/dashboard/work-experiences/{experience}', [WorkExperienceController::class, 'update'])
        ->name('work-experiences.update');
    Route::delete('/dashboard/work-experiences/{experience}', [WorkExperienceController::class, 'destroy'])
        ->name('work-experiences.destroy');

    // Registration Flow Routes
    Route::get('/work-experience', [WorkExperienceController::class, 'show'])
        ->name('work.experience');
    Route::post('/work-experience', [WorkExperienceController::class, 'store'])
        ->name('work.experience.store');
});

Route::middleware(['auth'])->group(function () {
    // skill routes
    Route::get('/skill', [skillController::class, 'show'])->name('skill');
    Route::post('/skill', [skillController::class, 'store'])->name('skill.store');
    Route::get('/dashboard/skill', [skillController::class, 'index'])->name('dashboard.skills');
    
    // Education routes
    Route::get('/education', [EducationController::class, 'show'])->name('education');
    Route::post('/education', [EducationController::class, 'store'])->name('education.store');
    Route::get('/dashboard/education', [EducationController::class, 'index'])->name('dashboard.education');
});

Route::middleware(['auth'])->group(function () {
    // Registration flow routes
    Route::get('/professional-summary', [ProfessionalSummaryController::class, 'show'])
        ->name('professional.summary');
});

Route::middleware(['auth', 'verified', 'employer'])->group(function () {
    Route::get('/dashboard/personal-information', [PersonalInformationController::class, 'index'])
        ->name('dashboard.employer.personal.information');
    // ... add other employer dashboard route definitions here 
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard/personal-information', [PersonalInformationController::class, 'index'])
        ->name('dashboard.personal.information');
    // ... add other jobfinder dashboard route definitions here 
});

Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, '__invoke'])
    ->middleware(['auth'])
    ->name('verification.verify');


    Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/applications/send/applied/email/{application}', [MailApplicationController::class, 'sendAppliedEmail'])->name('applications.send.applied.email');
    Route::post('/applications/send/accepted/email/{application}', [MailApplicationController::class, 'sendAcceptedEmail'])->name('applications.send.accepted.email');
    Route::post('/applications/send/rejected/email/{application}', [MailApplicationController::class, 'sendRejectedEmail'])->name('applications.send.rejected.email');
    Route::post('/applications/send/interview/scheduled/email/{application}', [MailApplicationController::class, 'sendInterviewScheduledEmail'])->name('applications.send.interview.scheduled.email');
});

require __DIR__.'/auth.php';
