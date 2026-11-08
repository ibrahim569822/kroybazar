import { useNavigate } from 'react-router';
import api from '../api';

export default function LogoutButton() {
  const navigate = useNavigate();

  const handleLogout = async () => {
    try {
      await api.post('/logout');   // deletes the token on the server
    } catch (e) {
      // the token may already be invalid, so we still clear the browser
    }
    localStorage.removeItem('token');
    localStorage.removeItem('user');
    navigate('/login');
  };

  return (
    <button className="btn btn-outline-danger" onClick={handleLogout}>
      Logout
    </button>
  );
}