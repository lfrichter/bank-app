import { BalanceDetail } from './BalanceDetail'

export interface Balance {
  balances?: BalanceDetail[];
  incomes: number;
  expenses: number;
}
