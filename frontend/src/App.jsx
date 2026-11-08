import { Routes, Route, Navigate } from 'react-router';
import Login from './pages/Login';
import AdminDashboard from './pages/AdminDashboard';
import VendorDashboard from './pages/VendorDashboard';
import ShopDashboard from './pages/ShopDashboard';
import ProtectedRoute from './auth/ProtectedRoute';
import PendingAccounts from './pages/PendingAccounts';

export default function App() {
  return (
    <Routes>
      <Route path="/login" element={<Login />} />
      <Route element={<ProtectedRoute role={1} />}>
        <Route path="/admin" element={<AdminDashboard />} />
        <Route path="/admin/accounts" element={<PendingAccounts />} />
      </Route>
      <Route element={<ProtectedRoute role={2} />}>
        <Route path="/vendor" element={<VendorDashboard />} />
      </Route>
      <Route element={<ProtectedRoute role={3} />}>
        <Route path="/shop" element={<ShopDashboard />} />
      </Route>
      <Route path="*" element={<Navigate to="/login" />} />
    </Routes>
  );
}