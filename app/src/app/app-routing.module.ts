import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './home/home.component';
import { WorkoutsComponent } from './workouts/workouts.component';
import { WorkoutDetailsComponent } from './workouts/workout-details/workout-details.component';
import { ExercisesComponent } from './exercises/exercises.component';
import { ExerciseDetailsComponent } from './exercises/exercise-details/exercise-details.component';

const routes: Routes = [
  { path: '', component: HomeComponent },
  { path: 'workouts', component: WorkoutsComponent },
  { path: 'workouts/:id', component: WorkoutDetailsComponent },
  { path: 'exercises', component: ExercisesComponent },
  { path: 'exercises/:id', component: ExerciseDetailsComponent }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
