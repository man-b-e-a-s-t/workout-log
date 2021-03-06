export class Workout {
  id: number = 0;
  userId: number = 0;
  name: string = ``;
  workoutDate: string = ``;
  notes: string = ``;
  created?: string;
  modified?: string;

  constructor(init?: Partial<Workout>) {
    this.userId = -1; // get the current user's id
    // this.workoutDate = init?.workoutDate ? new Date(init.workoutDate).toISOString().replace('.000Z', '').replace('T', '') : ``;
    console.log(this.workoutDate);
    // this.created = init?.created || new Date().toISOString();
    // this.modified = new Date().toISOString();
    Object.assign(this, init);
  }
}
