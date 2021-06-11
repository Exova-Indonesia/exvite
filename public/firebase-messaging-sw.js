/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
importScripts("https://www.gstatic.com/firebasejs/8.6.5/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/8.6.2/firebase-messaging.js");

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
firebase.initializeApp({
    apiKey: "AIzaSyBem8hm_QXgBkzrVI7deL9YgC83Nkf99v0",
    authDomain: "elated-oxide-290910.firebaseapp.com",
    databaseURL: "https://elated-oxide-290910.firebaseio.com",
    projectId: "elated-oxide-290910",
    storageBucket: "elated-oxide-290910.appspot.com",
    messagingSenderId: "919542326880",
    appId: "1:919542326880:web:c64fb34f3327949d40c505",
    measurementId: "G-1EN9PNZZSJ",
});

/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();
messaging.onBackgroundMessage((payload) => {
    // Customize notification here
    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
        icon: payload.notification.icon,
    };

    self.registration.showNotification(notificationTitle, notificationOptions);
});
