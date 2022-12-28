import { User } from './User'

export interface Check {
  id?: number;
  description: string;
  amount: number;
  image: string;
  status: string;
  created_at: string;
  user?: User;
}


