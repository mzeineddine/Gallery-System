import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import { BrowserRouter, Routes, Route } from "react-router";
import './index.css'
import Login from './Login.jsx'
import Signup from './Signup.jsx'
import Gallery from './Gallery.jsx'
import Edit from './Edit.jsx'
import Add from './Add.jsx'

createRoot(document.getElementById('root')).render(
  <BrowserRouter>
    <Routes>
      <Route path="/" element={<Login />} />
      <Route path="/signup" element={<Signup />} />
      <Route path="/Gallery" element={<Gallery />} />
      <Route path="/Edit" element={<Edit />} />
      <Route path='/Add' element={<Add />} />

    </Routes>
</BrowserRouter>
)
