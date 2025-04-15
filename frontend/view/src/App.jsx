import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import { Login } from "./Page/Login";
import { Main } from "./Page/Main";
export const App = () =>{
    return (
        <Router>
            <Routes>
                <Route path="/login" element={<Login />} />
                <Route path="/" element={<Main />} />
            </Routes>
        </Router>
    );
}

