import { useEffect, useState } from 'react';
import api from '../api';

export default function PendingAccounts() {
  const [accounts, setAccounts] = useState([]);
  const [message, setMessage] = useState('');

  const load = async () => {
    const res = await api.get('/admin/accounts/pending');
    setAccounts(res.data);
  };

  useEffect(() => {
    load();
  }, []);

  const act = async (id, action) => {
    await api.patch(`/admin/accounts/${id}/${action}`);
    setMessage(action === 'approve' ? 'Account approved' : 'Account rejected');
    load();
  };

  return (
    <div className="p-4">
      <h2>Pending Accounts</h2>
      {message && <div className="alert alert-success">{message}</div>}
      <table className="table">
        <thead>
          <tr>
            <th>Name</th><th>Email</th><th>Type</th><th>Business</th><th></th>
          </tr>
        </thead>
        <tbody>
          {accounts.map((a) => (
            <tr key={a.id}>
              <td>{a.name}</td>
              <td>{a.email}</td>
              <td>{a.role === 2 ? 'Warehouse' : 'Shop'}</td>
              <td>{a.vendor?.warehouse_name || a.shop?.shop_name}</td>
              <td>
                <button className="btn btn-success btn-sm me-2" onClick={() => act(a.id, 'approve')}>Approve</button>
                <button className="btn btn-danger btn-sm" onClick={() => act(a.id, 'reject')}>Reject</button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
      {accounts.length === 0 && <p>No pending accounts.</p>}
    </div>
  );
}