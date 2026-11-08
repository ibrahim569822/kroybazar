import { Navigate, Outlet } from 'react-router';

export default function ProtectedRoute({ role }) {
  const token = localStorage.getItem('token');
  const user = JSON.parse(localStorage.getItem('user') || 'null');

  // not logged in, or wrong role: back to the login page
  if (!token || !user || user.role !== role) {
    return <Navigate to="/login" replace />;
  }

  // allowed: show the page inside
  return <Outlet />;
}