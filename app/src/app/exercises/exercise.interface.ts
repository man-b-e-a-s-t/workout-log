export class Exercise {
  id: number = 0;
  userId: number = 0;
  name: string = ``;
  exerciseTypeId: number = 0;
  exerciseType: ExerciseType | undefined;
  notes: string = ``;
  created: string = ``;
  modified: string = ``;

  constructor(exerciseTypes?: ExerciseType[], init?: Partial<Exercise>) {
    this.userId = -1; // get the current user's id
    this.created = new Date().toISOString();
    Object.assign(this, init);

    this.exerciseType = exerciseTypes?.find(x => x.id == this.exerciseTypeId);
  }
}

export interface ExerciseType {
  id: number;
  name: string;
}
