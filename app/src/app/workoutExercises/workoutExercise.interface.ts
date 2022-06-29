export class WorkoutExercise {
  id: number = 0;
  userId: number = 0;
  workout_id: number = 0;
  exercise_id: number = 0;
  step_number: string = ``;
  weight_goal?: number;
  time_goal?: number;
  set_goal?: number;
  rep_goal?: number;
  notes: string = ``;
  created: string = ``;
  modified: string = ``;

  constructor(init?: Partial<WorkoutExercise>) {
    this.userId = -1; // get the current user's id
    this.created = init?.created || new Date().toISOString();
    this.modified = new Date().toISOString();
    Object.assign(this, init);
  }
}
