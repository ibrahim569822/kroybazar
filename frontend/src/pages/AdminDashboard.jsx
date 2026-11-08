import LogoutButton from '../components/LogoutButton';
import { Link } from 'react-router';

export default function AdminDashboard() {
  return (
    <div className="p-4">
      <h2>Admin Dashboard</h2>
      <Link to="/admin/accounts" className="btn btn-primary me-2">Pending accounts</Link>
      <LogoutButton />
    </div>
  );
}