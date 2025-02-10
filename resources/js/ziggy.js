const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"sanctum.csrf-cookie":{"uri":"sanctum\/csrf-cookie","methods":["GET","HEAD"]},"home":{"uri":"\/","methods":["GET","HEAD"]},"register.client":{"uri":"register-client","methods":["GET","HEAD"]},"personal.information.store":{"uri":"personal-information","methods":["POST"]},"personal.information.show":{"uri":"personal-information","methods":["GET","HEAD"]},"professional.summary":{"uri":"professional-summary","methods":["GET","HEAD"]},"work-experiences.index":{"uri":"dashboard\/work-experiences","methods":["GET","HEAD"]},"work-experiences.create":{"uri":"work-experiences\/create","methods":["GET","HEAD"]},"work-experiences.store":{"uri":"dashboard\/work-experiences","methods":["POST"]},"work-experiences.update":{"uri":"dashboard\/work-experiences\/{experience}","methods":["PUT"],"parameters":["experience"],"bindings":{"experience":"id"}},"work-experiences.destroy":{"uri":"dashboard\/work-experiences\/{experience}","methods":["DELETE"],"parameters":["experience"],"bindings":{"experience":"id"}},"performance.metrics":{"uri":"performance-metrics","methods":["GET","HEAD"]},"performance.metrics.update":{"uri":"performance-metrics\/{metric}","methods":["PUT"],"parameters":["metric"]},"performance.metrics.destroy":{"uri":"performance-metrics\/{metric}","methods":["DELETE"],"parameters":["metric"]},"job-types.index":{"uri":"admin\/job-types","methods":["GET","HEAD"]},"job-types.store":{"uri":"admin\/job-types","methods":["POST"]},"job-types.update":{"uri":"admin\/job-types\/{type}","methods":["PUT"],"parameters":["type"],"bindings":{"type":"id"}},"job-types.destroy":{"uri":"admin\/job-types\/{type}","methods":["DELETE"],"parameters":["type"],"bindings":{"type":"id"}},"messages.index":{"uri":"messages","methods":["GET","HEAD"]},"messages.store":{"uri":"messages","methods":["POST"]},"messages.update":{"uri":"messages\/{message}","methods":["PUT"],"parameters":["message"],"bindings":{"message":"id"}},"messages.destroy":{"uri":"messages\/{message}","methods":["DELETE"],"parameters":["message"],"bindings":{"message":"id"}},"notifications.index":{"uri":"notifications","methods":["GET","HEAD"]},"notifications.mark-read":{"uri":"notifications\/{notification}\/mark-read","methods":["POST"],"parameters":["notification"],"bindings":{"notification":"id"}},"notifications.mark-all-read":{"uri":"notifications\/mark-all-read","methods":["POST"]},"notifications.destroy":{"uri":"notifications\/{notification}","methods":["DELETE"],"parameters":["notification"],"bindings":{"notification":"id"}},"personal.information.update":{"uri":"personal-information","methods":["PUT"]},"personal.information.destroy":{"uri":"personal-information","methods":["DELETE"]},"preferences.show":{"uri":"preferences","methods":["GET","HEAD"]},"preferences.store":{"uri":"preferences","methods":["POST"]},"preferences.update":{"uri":"preferences","methods":["PUT"]},"jobs.index":{"uri":"employers\/jobs","methods":["GET","HEAD"]},"jobs.store":{"uri":"jobs","methods":["POST"]},"jobs.show":{"uri":"employers\/jobs\/{job}","methods":["GET","HEAD"],"parameters":["job"],"bindings":{"job":"id"}},"jobs.update":{"uri":"employers\/jobs\/{job}","methods":["PUT","PATCH"],"parameters":["job"],"bindings":{"job":"id"}},"jobs.destroy":{"uri":"employers\/jobs\/{job}","methods":["DELETE"],"parameters":["job"],"bindings":{"job":"id"}},"applications.index":{"uri":"applications","methods":["GET","HEAD"]},"applications.store":{"uri":"applications","methods":["POST"]},"applications.show":{"uri":"applications\/{application}","methods":["GET","HEAD"],"parameters":["application"]},"applications.update":{"uri":"applications\/{application}","methods":["PUT","PATCH"],"parameters":["application"]},"applications.destroy":{"uri":"applications\/{application}","methods":["DELETE"],"parameters":["application"]},"dashboard.education":{"uri":"dashboard\/education","methods":["GET","HEAD"]},"education.create":{"uri":"education\/create","methods":["GET","HEAD"]},"education.store":{"uri":"education","methods":["POST"]},"education.edit":{"uri":"education\/{education}\/edit","methods":["GET","HEAD"],"parameters":["education"],"bindings":{"education":"id"}},"education.update":{"uri":"education\/{education}","methods":["PUT"],"parameters":["education"],"bindings":{"education":"id"}},"education.destroy":{"uri":"education\/{education}","methods":["DELETE"],"parameters":["education"],"bindings":{"education":"id"}},"jobs.apply":{"uri":"jobs\/{job}\/apply","methods":["POST"],"parameters":["job"],"bindings":{"job":"id"}},"professional.summary.store":{"uri":"professional-summary","methods":["POST"]},"professional.summary.update":{"uri":"professional-summary","methods":["PUT"]},"professional.summary.destroy":{"uri":"professional-summary","methods":["DELETE"]},"profile.edit":{"uri":"profile\/edit","methods":["GET","HEAD"]},"profile.update":{"uri":"profile","methods":["PATCH"]},"profile.destroy":{"uri":"profile","methods":["DELETE"]},"reviews.index":{"uri":"reviews","methods":["GET","HEAD"]},"reviews.show":{"uri":"reviews\/{review}","methods":["GET","HEAD"],"parameters":["review"],"bindings":{"review":"id"}},"reviews.store":{"uri":"reviews","methods":["POST"]},"reviews.update":{"uri":"reviews\/{review}","methods":["PUT"],"parameters":["review"],"bindings":{"review":"id"}},"reviews.destroy":{"uri":"reviews\/{review}","methods":["DELETE"],"parameters":["review"],"bindings":{"review":"id"}},"saved-jobs.index":{"uri":"saved-jobs","methods":["GET","HEAD"]},"saved-jobs.store":{"uri":"saved-jobs","methods":["POST"]},"saved-jobs.update":{"uri":"saved-jobs\/{savedJob}","methods":["PUT"],"parameters":["savedJob"],"bindings":{"savedJob":"id"}},"saved-jobs.destroy":{"uri":"saved-jobs\/{savedJob}","methods":["DELETE"],"parameters":["savedJob"],"bindings":{"savedJob":"id"}},"saved-searches.index":{"uri":"saved-searches","methods":["GET","HEAD"]},"saved-searches.store":{"uri":"saved-searches","methods":["POST"]},"saved-searches.update":{"uri":"saved-searches\/{search}","methods":["PUT"],"parameters":["search"],"bindings":{"search":"id"}},"saved-searches.destroy":{"uri":"saved-searches\/{search}","methods":["DELETE"],"parameters":["search"],"bindings":{"search":"id"}},"skills":{"uri":"skills","methods":["GET","HEAD"]},"skills.create":{"uri":"skills\/create","methods":["GET","HEAD"]},"skills.store":{"uri":"skills","methods":["POST"]},"skills.update":{"uri":"skills\/{skill}","methods":["PUT"],"parameters":["skill"],"bindings":{"skill":"id"}},"skills.destroy":{"uri":"skills\/{skill}","methods":["DELETE"],"parameters":["skill"],"bindings":{"skill":"id"}},"activity-logs.index":{"uri":"activity-logs","methods":["GET","HEAD"]},"activity-logs.store":{"uri":"activity-logs","methods":["POST"]},"activity-logs.update":{"uri":"activity-logs\/{log}","methods":["PUT"],"parameters":["log"],"bindings":{"log":"id"}},"activity-logs.destroy":{"uri":"activity-logs\/{log}","methods":["DELETE"],"parameters":["log"],"bindings":{"log":"id"}},"engagements.index":{"uri":"engagements","methods":["GET","HEAD"]},"engagements.store":{"uri":"engagements","methods":["POST"]},"engagements.update":{"uri":"engagements\/{engagement}","methods":["PUT"],"parameters":["engagement"],"bindings":{"engagement":"id"}},"engagements.destroy":{"uri":"engagements\/{engagement}","methods":["DELETE"],"parameters":["engagement"],"bindings":{"engagement":"id"}},"dashboard.skills":{"uri":"dashboard\/skills","methods":["GET","HEAD"]},"dashboard.professional.summary":{"uri":"dashboard\/professional-summary","methods":["GET","HEAD"]},"work.experience":{"uri":"work-experience","methods":["GET","HEAD"]},"education":{"uri":"education","methods":["GET","HEAD"]},"certification":{"uri":"certification","methods":["GET","HEAD"]},"account.success":{"uri":"account-success","methods":["GET","HEAD"]},"kotekot":{"uri":"kotekot","methods":["GET","HEAD"]},"dashboard":{"uri":"dashboard","methods":["GET","HEAD"]},"random-text":{"uri":"random-text","methods":["GET","HEAD"]},"job.details":{"uri":"job\/{id}","methods":["GET","HEAD"],"parameters":["id"]},"dashboard.personal.information":{"uri":"dashboard\/personal-information","methods":["GET","HEAD"]},"dashboard.work.experience":{"uri":"dashboard\/work-experience","methods":["GET","HEAD"]},"dashboard.certifications":{"uri":"dashboard\/certifications","methods":["GET","HEAD"]},"dashboard.applications":{"uri":"dashboard\/applications","methods":["GET","HEAD"]},"register":{"uri":"register","methods":["GET","HEAD"]},"test.email":{"uri":"test-email","methods":["GET","HEAD"]},"work.experience.store":{"uri":"work-experience","methods":["POST"]},"interviews.destroy":{"uri":"interviews\/{interview}","methods":["DELETE"],"parameters":["interview"],"bindings":{"interview":"id"}},"employers.reviews.store":{"uri":"employers\/{employer}\/reviews","methods":["POST"],"parameters":["employer"],"bindings":{"employer":"id"}},"applications.schedule.interview":{"uri":"applications\/{application}\/schedule-interview","methods":["POST"],"parameters":["application"],"bindings":{"application":"id"}},"jobs.save":{"uri":"jobs\/{job}\/save","methods":["POST"],"parameters":["job"]},"interviews.index":{"uri":"interviews","methods":["GET","HEAD"]},"employers.jobs.create":{"uri":"employers\/jobs\/create","methods":["GET","HEAD"]},"employers.jobs.store":{"uri":"employers\/jobs","methods":["POST"]},"jobs.edit":{"uri":"employers\/jobs\/{job}\/edit","methods":["GET","HEAD"],"parameters":["job"],"bindings":{"job":"id"}},"job-listings.categories.index":{"uri":"jobs\/{jobListing}\/categories","methods":["GET","HEAD"],"parameters":["jobListing"],"bindings":{"jobListing":"id"}},"job-listings.categories.store":{"uri":"jobs\/{jobListing}\/categories","methods":["POST"],"parameters":["jobListing"],"bindings":{"jobListing":"id"}},"job-listings.categories.destroy":{"uri":"jobs\/{jobListing}\/categories\/{category}","methods":["DELETE"],"parameters":["jobListing","category"],"bindings":{"jobListing":"id","category":"id"}},"event-logs.index":{"uri":"admin\/event-logs","methods":["GET","HEAD"]},"event-logs.store":{"uri":"admin\/event-logs","methods":["POST"]},"event-logs.update":{"uri":"admin\/event-logs\/{eventLog}","methods":["PUT"],"parameters":["eventLog"],"bindings":{"eventLog":"id"}},"event-logs.destroy":{"uri":"admin\/event-logs\/{eventLog}","methods":["DELETE"],"parameters":["eventLog"],"bindings":{"eventLog":"id"}},"job-categories.index":{"uri":"admin\/job-categories","methods":["GET","HEAD"]},"job-categories.store":{"uri":"admin\/job-categories","methods":["POST"]},"job-categories.update":{"uri":"admin\/job-categories\/{category}","methods":["PUT"],"parameters":["category"],"bindings":{"category":"id"}},"job-categories.destroy":{"uri":"admin\/job-categories\/{category}","methods":["DELETE"],"parameters":["category"],"bindings":{"category":"id"}},"company.info":{"uri":"company-info","methods":["GET","HEAD"]},"company.info.store":{"uri":"company-info","methods":["POST"]},"dashboard.company.info":{"uri":"dashboard\/company-info","methods":["GET","HEAD"]},"dashboard.company.info.store":{"uri":"dashboard\/company-info","methods":["POST"]},"dashboard.company.info.update":{"uri":"dashboard\/company-info\/{employer}","methods":["PUT"],"parameters":["employer"]},"dashboard.company.info.destroy":{"uri":"dashboard\/company-info\/{employer}","methods":["DELETE"],"parameters":["employer"]},"dashboard.personal.information.update":{"uri":"dashboard\/personal-information","methods":["PUT"]},"login":{"uri":"login","methods":["GET","HEAD"]},"password.request":{"uri":"forgot-password","methods":["GET","HEAD"]},"password.email":{"uri":"forgot-password","methods":["POST"]},"password.reset":{"uri":"reset-password\/{token}","methods":["GET","HEAD"],"parameters":["token"]},"password.store":{"uri":"reset-password","methods":["POST"]},"verification.notice":{"uri":"verify-email","methods":["GET","HEAD"]},"verification.verify":{"uri":"verify-email\/{id}\/{hash}","methods":["GET","HEAD"],"parameters":["id","hash"]},"verification.send":{"uri":"email\/verification-notification","methods":["POST"]},"password.confirm":{"uri":"confirm-password","methods":["GET","HEAD"]},"password.update":{"uri":"password","methods":["PUT"]},"logout":{"uri":"logout","methods":["POST"]},"storage.local":{"uri":"storage\/{path}","methods":["GET","HEAD"],"wheres":{"path":".*"},"parameters":["path"]}}};
if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
  Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };
