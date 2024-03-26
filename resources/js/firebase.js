// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";

import "firebase/firestore";
import "firebase/storage";
import {
	getStorage,
	listAll,
	ref,
	uploadBytes,
	uploadString,
} from "firebase/storage";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
	apiKey: "AIzaSyCQ7wSBS0YEag8J2MCwKKdf55AcKHBPhXs",
	authDomain: "numismatico-5d028.firebaseapp.com",
	projectId: "numismatico-5d028",
	storageBucket: "numismatico-5d028.appspot.com",
	messagingSenderId: "313448873",
	appId: "1:313448873:web:0ea4d6ad150a647b4d8cb8",
	measurementId: "G-4LW2JEXH6G",
};

// Initialize Firebase
export const app = initializeApp(firebaseConfig);
export const analytics = getAnalytics(app);
export const storage = getStorage(app);

export const rf = ref;

export const upStr = uploadString;
export const upBts = uploadBytes;
export const list = listAll;
